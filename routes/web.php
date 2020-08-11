<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/activate/{code}', 'ActivationController@activate')->name('activate');
Route::get('/resend/code/', 'ActivationController@resendCode')->name('code.resend');
