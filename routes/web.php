<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\CategoryController;

Route::get('/', fn() => redirect()->route('letters.index'));

// Semua route untuk letters
Route::resource('letters', LetterController::class);
Route::get('letters/{letter}/stream', [LetterController::class,'stream'])->name('letters.stream');

// Semua route untuk categories
Route::resource('categories', CategoryController::class);

// Static page
Route::view('/about','about')->name('about');
