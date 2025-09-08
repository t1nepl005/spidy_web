<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Activities\StreetFoodController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/member/sample', function() {
    return view('members.sample');
});

Route::get('/member/dxvid', function() {
    return view('members.david');
});

Route::get('member/peterjohn', function() {
    return view('members.peterjohn');
});

Route::get('/member/tine', function() {
    return view('members.christine');
});


// Route::get('/member/{id}', [HomeController::class, 'member']); future feature na to
Route::get('/activities', [ActivityController::class, 'index']);




// group this for the activities as inisde it 
// For the streetfood feature/activity namin
Route::group(['prefix' => 'activities'], function() {
    // with name please
    Route::get('/streetfood', [StreetFoodController::class, 'index'])->name('streetfood.index');
    Route::get('/streetfood/create', [StreetFoodController::class, 'create'])->name('streetfood.create');
    Route::post('/streetfood', [StreetFoodController::class, 'store'])->name('streetfood.store');
    Route::get('/streetfood/{id}', [StreetFoodController::class, 'show'])->name('streetfood.show');
    Route::get('/streetfood/{id}/edit', [StreetFoodController::class, 'edit'])->name('streetfood.edit');
    Route::put('/streetfood/{id}', [StreetFoodController::class, 'update'])->name('streetfood.update');
    Route::delete('/streetfood/{id}', [StreetFoodController::class, 'destroy'])->name('streetfood.destroy');
});

Route::get('/activities/{id}', [\App\Http\Controllers\Activities\Activity1Controller::class, 'index']);
