<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home.index')->name('home');
Route::livewire('/login', 'pages::auth.login')->name('login');
Route::livewire('/register', 'pages::auth.register')->name('register');
