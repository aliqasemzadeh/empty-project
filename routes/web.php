<?php

use Illuminate\Support\Facades\Route;

//Public Routes
Route::livewire('/', 'pages::home.index')->name('home');

//User Routes
Route::group(['middleware' => ['auth']], function () {

    Route::livewire('/settings/profile-information', 'pages::settings.profile-information')->name('settings.profile-information');
    Route::livewire('/settings/change-email', 'pages::settings.change-email')->name('settings.change-email');
    Route::livewire('/settings/change-password', 'pages::settings.change-password')->name('settings.change-password');




    Route::livewire('/logout', 'pages::auth.logout')->name('logout');
});

//Guest Routes
Route::group(['middleware' => ['guest']], function () {
    Route::livewire('/login', 'pages::auth.login')->name('login');
    Route::livewire('/register', 'pages::auth.register')->name('register');
});

