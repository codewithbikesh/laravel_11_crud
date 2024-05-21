<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
//   This method will show login page for customer 
public function login(){
     return view('account.login');
}

// This method will authenticate user 
public function authenticate(Request $request){
     $validator = Validator::make($request->all(),[
     'email' => 'required|email',
     'password' => 'required'
     ]);
     if($validator->passes()){
       if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
         
       }else{
        return redirect()->route('account.login')->with('Either email or password is incorrect.');
       }
     }else{
        return redirect()->route('account.login')->withInput()->withErrors($validator);
     }

}

// This method will show register page 
 public function register(){
    return view('account.register');
 }

 public function processRegister(Request $request){
    $validator = Validator::make($request->all(),[
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
        ]);
        if($validator->passes()){
        $user = new User();
        $user->name = $request->name;
        $user ->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'customer';
        $user->save();

        return redirect()->route('account.login')->with('success','You have register successfully.');
        }else{
           return redirect()->route('account.register')->withInput()->withErrors($validator);
        }
 }

}
