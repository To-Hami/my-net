<?php


use Illuminate\Support\Facades\Route;


Route::prefix('dashboard')->middleware(['auth'])->name('dashboard.')->group(function () {


    Route::get('/dashboard', 'dashboardController@index')->name('index');


    //resource routes
    Route::resource('categories', 'categoryController');
    Route::resource('roles', 'roleController');
    Route::resource('users', 'userController');
    Route::resource('movies', 'movieController');


    // social links
    Route::get('/setting/social_login', 'settingController@social_login')->name('setting.social_login');
    Route::get('/setting/social_link', 'settingController@social_link')->name('setting.social_link');

    // setting links
    Route::post('/setting/store', 'settingController@store')->name('setting.store');

});








