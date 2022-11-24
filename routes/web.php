<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 登入頁
Route::get('/login', 'UserController@login');
// 送出登入頁
Route::post('/login', 'UserController@check');

Route::middleware('guest:user')->group(function () {
    // 待辦首頁
    Route::get('/', 'ListController@home');
    // 送出待辦事項
    Route::post('/add', 'ListController@addList');
    // 登出重導向
    Route::get('/logout', 'UserController@logout');
});
Route::fallback(function () {
    return back()->withErrors([
        'errors' => ['不存在的頁面！']
    ]);
});
