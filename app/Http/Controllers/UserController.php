<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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
        // 自動驗證
        $validated = $this->validate($request, [
            'account' => "required|string|min:6|max:20",
            'password' => "required|string|min:6|max:20",
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $inputArray = collect($validated)->except('g-recaptcha-response');

        // 與 Auth 做驗證
        if (!Auth::guard('user')->attempt($inputArray->all())) {
            return redirect('login')->withErrors([
                'errors' => ['帳號或密碼錯誤!']
            ]);
        };
        return redirect('/');
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
