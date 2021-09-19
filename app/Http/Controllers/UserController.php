<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{

    public function login()
    {
        return view("userpanel.index");
    }

    public function registration()
    {
        return view("userpanel.register");
    }

    public function registerUser(Request $request) {

        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'mobile'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'
        ],
        [
            'firstname.required'=> 'Please Enter Your First Name',
            'lastname.required'=> 'Please Enter Your First Name',
            'mobile.required'=> 'Please Enter Your Mobile Number',
            'email.required'=> 'Please Enter Your Email',
            'password.required'=> 'Your Enter Password',
        ]);

        $user = new User();
        $user->userpanel_firstnm = $request->firstname;
        $user->userpanel_lastnm = $request->lastname;
        $user->userpanel_mobile = $request->mobile;
        $user->userpanel_email = $request->email;
        $user->userpanel_password = Has::make($request->password);
        $res = $user->save();

        if($res) {
            return back()->with('success', 'You have registered successfully');
        } else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function loginUser(Request $request) {
        $request->validate([
            'auth-email'=>'required|email|unique:users',
            'auth-password'=>'required|min:5|max:12'
        ],
        [
            'auth-email.required'=> 'Your Enter Valid Login Id',
            'auth-password.required'=> 'Your Enter Valid Password',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if($user) {
            if(Has::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'Password Not matches');
            }
        } else {
                return back()->with('fail', 'This email is not registered');
        }
    }

    public function dashboard() {

        return "Welcome!! To your dashboard";
    }


}
