<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return  view('Page.login.login');
        //return  view('welcome');
    }
    public function register()
    {
        return  view('Page.login.register');
    }



    public function profile()
    {
        return  view('Page.login.profile');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('logins'));
    }
}
