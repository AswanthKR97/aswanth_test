<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\UserDetails;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.registeration');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // function to edit profile
    public function edit($id)
    {
      $result = User::where('users.id',\Crypt::decrypt($id))
                ->leftjoin('users_details','users.id','=','users_details.user_id')
                ->select('users.id','users.name','users.email','users_details.dob','users_details.city')
                ->first();
                return view('users.edit',compact('result'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // function to update profle
    public function update(Request $request, $id)
    {
        User::where('id',\Crypt::decrypt($id))->update([
          'name'=>$request->name,
          'email'=>$request->email,
        ]);
        UserDetails::where('user_id',\Crypt::decrypt($id))->update([
          'dob'=>$request->dob,
          'city'=>$request->city,
        ]);
        return redirect()->route('home');
    }
    // function to send verification mail
    public function sendmail()
    {
      return 'mail';
    }
    // function to match OTP
    public function verifyOTP(Request $request )
    {
      $result = User::where('users.id',\Auth::user()->id)
                ->leftjoin('users_details','users.id','=','users_details.user_id')
                ->select('users.id','users.name','users.email','users_details.dob','users_details.city','users_details.verified','users_details.otp')
                ->first();
      if($request->otp == $result->otp)
      {
        UserDetails::where('user_id',\Auth::user()->id)->update(['verified'=>1]);
        return redirect()->route('home');
      }
      else {
        return back()->with('error','Invalid OTP.Please Try again.');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
