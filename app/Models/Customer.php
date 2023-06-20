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

class Customer extends Model
{    
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;
    use HasFactory;

    public $table = 'customers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'email',
        'password',
        'name',
        'mobile_number',
        'profile_image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'password' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'mobile_number' => 'string',
        'profile_image' => 'string',
        'remember_token' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'name' => 'nullable|string|max:255',
        'mobile_number' => 'nullable|string|max:255',
        'profile_image' => 'nullable|string|max:255',
        'remember_token' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
    ];

    public function getProfileImageAttribute($value)
    {
        return URL::to('/profile_images/') .'/'. $value; 
    }
    //Check exsting customer and create
    public function checkExistingCustomer($request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if(null == $customer){
            $save = new Customer;
            $save->email = $request->email;
            $save->name = $request->name;
            $save->password = Hash::make('123456789');
            $save->mobile_number = $request->mobile_number;
            $save->save();

            return $save;
        }
        return $customer;
    }
}
