<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all tickets details if admin
        if (auth()->user()->role_id == 1) {
            $count = [];
            $count['total'] = Ticket::get()->count();
            $count['new'] = Ticket::where('status','New')->get()->count();
            $count['pending'] = Ticket::where('status','Pending')->get()->count();
            $count['completed'] = Ticket::where('status','Completed')->get()->count();
    
            return view('home')->with('count',$count);
        }
        //Get only assigned tickets 
        $count = [];
        $count['total'] = Ticket::where('followed_by',auth()->user()->id)->get()->count();
        $count['new'] = Ticket::where('followed_by',auth()->user()->id)->where('status','New')->get()->count();
        $count['pending'] = Ticket::where('followed_by',auth()->user()->id)->where('status','Pending')->get()->count();
        $count['completed'] = Ticket::where('followed_by',auth()->user()->id)->where('status','Completed')->get()->count();

        return view('home')->with('count',$count);
   
    }
}
