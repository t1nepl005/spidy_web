<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
Route::get('/', [HomeController::class, 'index']);

Route::get('/member/sample', function() {
    return view('members.sample');
});

Route::get('/member/dxvid', function() {
    return view('members.david');
});


// Route::get('/member/{id}', [HomeController::class, 'member']); future feature na to
Route::get('/activities', [ActivityController::class, 'index']);



Route::get('/activities/{id}', [\App\Http\Controllers\Activities\Activity1Controller::class, 'index']);
