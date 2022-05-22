<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Hash;

class AdminController extends Controller
{
    function login()
    {
      //  echo Hash::make('admin1122');
       return view('admin.login');
    }
    function makeLogin(Request $reequest)
    {
      
        $data = array(
            'email'=> $reequest->email,
            'password'=> $reequest->password,
            'role'=>'admin',
        );
        if(Auth::attempt($data)){
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return back()->withErrors(['message'=>'invalid email and password']);
        }
    }
    function dashboard()
    {
        return view('admin.dashboard');
    }
}
