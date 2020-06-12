<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\UserDetails;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $result = User::where('users.id',\Auth::user()->id)
                  ->leftjoin('users_details','users.id','=','users_details.user_id')
                  ->select('users.id','users.name','users.email','users_details.dob','users_details.city','users_details.verified','users_details.otp')
                  ->first();
        $otp = $result->otp;
        $id = $result->id;
        // $id = \Crypt::encrypt($result->id);
        if($result->verified){
          return view('home',compact('result'));
        }
        else {
          return view('users.verify',compact('id'));
        }
    }
}
