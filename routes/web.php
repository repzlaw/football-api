<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\FixtureController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fixtures', [FixtureController::class, 'index']);
Route::get('/clubs', [ClubController::class, 'index']);
Route::get('/clubs/{slug}', [ClubController::class, 'show']);
