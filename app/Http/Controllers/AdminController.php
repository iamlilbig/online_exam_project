<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('login.admin');
    }

    public function logout(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = ['email' => $request->post('email'), 'password' => $request->post('password'),'is_active' => '1'];

        if(Auth::guard('admin')->attempt($credentials)){
            return redirect(route('admin.home'));

        }

        return redirect()->back()->withErrors('your inputs are invalid or your account is not confirm');
    }

    public function showHomePage()
    {
        return view('dashboard.admins.home');
    }
}
