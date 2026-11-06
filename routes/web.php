<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->get('/dashboard', fn () => view('dashboard'))->name('dashboard');