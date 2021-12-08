<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
//        $this->middleware('can:admin')->except(['showLoginForm','login']);
    }

    public function showLoginForm()
    {
        return view('login.admin');
    }

    public function logout(Request $request): Redirector|Application|RedirectResponse
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
//        dd(Auth::guard('admin')->check());

        return view('dashboard.admins.home');
    }
}
