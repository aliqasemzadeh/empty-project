<?php

use Illuminate\Support\Facades\Route;


//User Routes
Route::group(['middleware' => ['auth']], function () {

    //Public Routes
    Route::livewire('/', 'pages::panels.user.dashboard.index')->name('home');
    Route::livewire('/panels/user/dashboard/index', 'pages::panels.user.dashboard.index')->name('panels.user.dashboard.index');

    Route::livewire('/settings/profile-information', 'pages::settings.profile-information')->name('settings.profile-information');
    Route::livewire('/settings/change-email', 'pages::settings.change-email')->name('settings.change-email');
    Route::livewire('/settings/change-password', 'pages::settings.change-password')->name('settings.change-password');

    Route::livewire('/panels/administrator/dashboard/index', 'pages::panels.administrator.dashboard.index')->name('panels.administrator.dashboard.index');
    Route::livewire('/panels/administrator/user-management/user/index', 'pages::panels.administrator.user-management.user.index')->name('panels.administrator.user-management.user.index');
    Route::livewire('/panels/administrator/user-management/role/index', 'pages::panels.administrator.user-management.role.index')->name('panels.administrator.user-management.role.index');
    Route::livewire('/panels/administrator/user-management/permission/index', 'pages::panels.administrator.user-management.permission.index')->name('panels.administrator.user-management.permission.index');

    Route::livewire('/logout', 'pages::auth.logout')->name('logout');
});

//Guest Routes
Route::group(['middleware' => ['guest']], function () {
    Route::livewire('/login', 'pages::auth.login')->name('login');
    Route::livewire('/register', 'pages::auth.register')->name('register');
});

