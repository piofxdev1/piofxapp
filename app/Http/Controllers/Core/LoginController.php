<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function authenticate(Request $request){
        // Retrive Input
        $credentials = $request->only('email', 'password','client_id');


        if (Auth::attempt($credentials)) {
            // if success login
            return redirect('/admin');
        }
        $alert = 'Invalid Email or Password';
        // if failed login
        return redirect('login')->with('alert',$alert);
    }
}