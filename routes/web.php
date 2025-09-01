<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
Route::get('/', [HomeController::class, 'index']);

Route::get('/member/{id}', [HomeController::class, 'member']);

Route::get('/activities', [ActivityController::class, 'index']);
