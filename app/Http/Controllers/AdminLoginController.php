<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }


    public function loginForm()
    {
        return view('admins.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::guard('admin')->attempt($credentials)) {

            return back()->withErrors([
                'message' => 'Wrong Email or Password , Please try again'
            ]);
        }
        return redirect('/admin/home');
    }


    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('admin/login')->with('success', 'You have been logged out');
    }
}
