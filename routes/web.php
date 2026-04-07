<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NotesController;

Route::middleware('guest')->group(function(){
    Route::get('/', [SessionController::class, 'create'])->name('login');
    Route::post('/', [SessionController::class, 'authenticate'])->name('login.auth');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function(){
    Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');
    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
});
