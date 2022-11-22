<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('public.login');
    }

    public function check(Request $request)
    {
        $result = $this->validate($request, [
            'account' => "required|min:6|max:20",
            'password' => "required|min:6|max:20",
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $result = collect($result)->except('g-recaptcha-response');
        if (Auth::guard('user')->attempt($result->all())) {
            return redirect('/');
        };
        return redirect('login')->withErrors([
            'errors' => ['帳號或密碼錯誤!']
        ]);
    }

    public function home()
    {
        return view('public.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
