<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// User Login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Admin Login
Route::get('/admin/login', function () {
    return view('login');
})->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

// Protected Routes (Require Login)
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
});

// Admin Routes (Require Admin Login)
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', function () {
    return view('layouts.app'); 
})->name('home');
