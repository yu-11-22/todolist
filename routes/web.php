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
Route::get('/login', 'UserController@login');
Route::post('/login', 'UserController@check');

Route::middleware('guest:user')->group(function () {
    Route::get('/', 'UserController@home');
    Route::get('/logout', 'UserController@logout');
});
