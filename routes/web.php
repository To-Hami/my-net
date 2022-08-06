<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.dashboard');
})->name('index');


Auth::routes(['register' => false]);

Route::get('login/{{provider}}', 'Auth\LoginController@redirectToProvider')->where('provider', 'facebook|google');
Route::get('login/{{provider}}/callback', 'Auth\LoginController@handleProviderCallback')->where('provider', 'facebook|google');



