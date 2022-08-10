<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'welcomeController@index')->name('welcome');

Auth::routes();

Route::post('/movies/{movie}/increment_views', 'movieController@increment_views')->name('movies.increment_views');
Route::post('/movies/{movie}/toggle_favorite', 'movieController@toggle_favorite')->name('movies.toggle_favorite');
route::resource('movies', 'movieController')->only(['index', 'show']);

Route::get('login/{{provider}}', 'Auth\LoginController@redirectToProvider')->where('provider', 'facebook|google');
Route::get('login/{{provider}}/callback', 'Auth\LoginController@handleProviderCallback')->where('provider', 'facebook|google');



