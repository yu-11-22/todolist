@extends('layout.frontend')

@section('title', '登入頁')

@section('header')
<div class="composing">
    <a href="/">
        <h1>Todo List</h1>
    </a>
    <a href="/">
        後台管理
    </a>
</div>
@endsection

@section('content')
<div class="login text-center">
    <div class="title">
        <h2>歡迎登入</h2>
    </div>
    <form action="login" method="post">
        @csrf
        <div class="loginInput">
            <div class="account">
                <p>
                    帳號：<input type="account" name="account" autofocus required>
                </p>
            </div>
            <div class="password">
                <p>
                    密碼：<input type="password" name="password" required>
                </p>
            </div>
        </div>
        <div class="recaptcha pt-4 pb-5">
            <div class="g-recaptcha" data-sitekey="{{ config('captcha.sitekey') }}"></div>
        </div>
        <div class="loginButton">
            <p>
                <button class="btn-dark" type="button">忘記密碼</button>
            </p>
            <p>
                <button class="btn-dark" type="submit">登入</button>
            </p>
        </div>
    </form>
</div>
@endsection
