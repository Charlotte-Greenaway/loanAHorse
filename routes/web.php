<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HorseListingController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/sign-in', [AuthController::class, 'showLoginPage'])->name('sign-in');

Route::post('/auth/sign-in', [AuthController::class, 'signIn']);

Route::post('/auth/sign-up', [AuthController::class, 'signUp']);

Route::get('/auth/sign-out', [AuthController::class, 'signOut'])->name('signOut');

Route::get('/list-a-horse', [HorseListingController::class, 'showHorseListingForm'])->name('list-a-horse');

Route::post('/list-a-horse/submit', [HorseListingController::class, 'listHorse'])->name('list-horse-submit');

Route::get('/view-your-listing/{id}', [HorseListingController::class, 'viewListing'])->name('view-your-listing');
