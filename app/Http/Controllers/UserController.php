<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 登入頁介面
     *
     * @return void
     */
    public function login()
    {
        return view('public.login');
    }

    /**
     * 登入驗證
     *
     * @param Request $request
     * @return void
     */
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

    /**
     * 前台首頁
     *
     * @return void
     */
    public function home()
    {
        return view('public.home');
    }

    /**
     * 登出重導向
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
