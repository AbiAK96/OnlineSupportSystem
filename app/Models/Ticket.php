<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Ticket extends Model
{    
    use Notifiable;
    use SoftDeletes;
    use HasFactory;

    public $table = 'tickets';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    const STATUS = [
        'Pending' => 'Pending',
        'Ongoing' => 'Ongoing',
        'Completed' => 'Completed'
    ];


    public $fillable = [
        'customer_id',
        'description',
        'ticket_number',
        'status',
        'followed_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_id' => 'integer',
        'description' => 'string',
        'ticket_number' => 'string',
        'status' => 'string',
        'followed_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'customer_id' => 'required|integer|max:255',
        'description' => 'required|string|max:255',
        'ticket_number' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'followed_by' => 'nullable|integer|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
    ];

    public function getProfileImageAttribute($value)
    {
        return URL::to('/profile_images/') .'/'. $value; 
    }

    public function user()
    {
    	return $this->hasOne('App\Models\User', 'id', 'followed_by');
    }

    public function customer()
    {
    	return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }

    public function message()
    {
    	return $this->hasMany('App\Models\TicketItems', 'ticket_id', 'id');
    }

    private function generateTicketNumber($customer)
    {
        $timestamp = now()->timestamp;
        $randomString = Str::random(8);
        //Generate ticketNumber 
        $dataToHash = $customer->id. $timestamp . $randomString;
        $hashedData = hash('sha256', $dataToHash);

    return strtoupper($hashedData);
    }
    
    public function createTicket($customer,$request)
    {
        //Create ticket
        $save = new Ticket;
        $save->customer_id = $customer->id;
        $save->description = $request->description;
        $save->ticket_number = Ticket::generateTicketNumber($customer);
        $save->status = 'New';
        $save->save();
        return $save;
    }

    public function getTicketByRole($role_id)
    {
        //Get ticket by role
        if ($role_id === 1) {
            $tickets = Ticket::with('user','customer')->OrderBy('id', 'desc')->paginate(10);
            return $tickets;   
        }
        $tickets = Ticket::with('user','customer')->where('followed_by',auth()->user()->id)->OrderBy('id', 'desc')->paginate(10);
        return $tickets;  
    }
}
