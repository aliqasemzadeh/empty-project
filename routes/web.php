<?php

use Illuminate\Support\Facades\Route;

//Public Routes
Route::livewire('/', 'pages::home.index')->name('home');

//User Routes
Route::group(['middleware' => ['auth']], function () {

    Route::livewire('/logout', 'pages::auth.logout')->name('logout');
});

//Guest Routes
Route::group(['middleware' => ['guest']], function () {
    Route::livewire('/login', 'pages::auth.login')->name('login');
    Route::livewire('/register', 'pages::auth.register')->name('register');
});

