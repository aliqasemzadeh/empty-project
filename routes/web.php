<?php

use Illuminate\Support\Facades\Route;


//User Routes
Route::group(['middleware' => ['auth']], function () {

    //Public Routes
    Route::livewire('/', 'pages::home.index')->name('home');

    Route::livewire('/settings/profile-information', 'pages::settings.profile-information')->name('settings.profile-information');
    Route::livewire('/settings/change-email', 'pages::settings.change-email')->name('settings.change-email');
    Route::livewire('/settings/change-password', 'pages::settings.change-password')->name('settings.change-password');

    Route::livewire('/panels/administrator/user-management/index', 'pages::settings.change-password')->name('panels.administrator.user-management.index');

    Route::livewire('/logout', 'pages::auth.logout')->name('logout');
});

//Guest Routes
Route::group(['middleware' => ['guest']], function () {
    Route::livewire('/login', 'pages::auth.login')->name('login');
    Route::livewire('/register', 'pages::auth.register')->name('register');
});

