<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin_login', function() {
    auth()->loginUsingId(1);
    return redirect('/');
});

Route::get('manager_login', function() {
    auth()->loginUsingId(2);
    return redirect('/');
});

Route::get('user_login', function() {
    auth()->loginUsingId(3);
    return redirect('/');
});
