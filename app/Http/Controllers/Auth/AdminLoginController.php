<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminLoginController extends Controller
{

    public function __construct() {
    $this->middleware('guest:admin');
    }

    public function showLoginForm() {
        return view('auth.admin-login');
    }

    public function login(Request $request) {
        
        //Validate the request
        $this->validate($request,[
            'email'     =>  'required|email',
            'password'  =>  'required|min:6'
        ]);
        
        $credentials = ['email'=>$request->input('email'),'password'=>$request->input('password')];
        //Attempt tp login
        
        if (Auth::guard('admin')->attempt($credentials,$request->input('remember'))){
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
