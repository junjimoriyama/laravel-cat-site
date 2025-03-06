<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Route::view('index');

Route::view('/','index');


Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/contact', [ContactController::class, 'sendMail'])->name('contact.send');

Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');
