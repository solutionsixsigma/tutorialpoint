<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    function login() {
        return view('login');
    }

    function register() {
        return view('register');
    }

    function authlogin(Request $request) {

        //Validate Request
        
        $request->validate([
            'logemail'=>'required|email',
            'logpassword'=>'required|min:5|max:12'
        ]);
    }
}
