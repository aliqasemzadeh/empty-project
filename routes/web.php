<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home.index')->name('home');
Route::livewire('/login', 'pages::auth.login')->name('login');
