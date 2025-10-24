<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Activities\StreetFoodController;
use App\Http\Controllers\Activities\Activity1Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoListChristineController;
use App\Http\Controllers\Activities\DavidTodoListController;

Route::get('/', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
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
});


// Route::get('/member/{id}', [HomeController::class, 'member']); future feature na to
Route::get('/activities', [ActivityController::class, 'index']);


// group this for the activities as inisde it 
Route::group(['prefix' => '/activities'], function() {

    // SDtreetfood
    Route::group(['prefix' => '/streetfood'], function() {
        Route::get('/', [StreetFoodController::class, 'index'])->name('streetfood.index');
        Route::get('/create', [StreetFoodController::class, 'create'])->name('streetfood.create');
        Route::post('/', [StreetFoodController::class, 'store'])->name('streetfood.store');
        Route::get('/{id}', [StreetFoodController::class, 'show'])->name('streetfood.show');
        Route::get('/{id}/edit', [StreetFoodController::class, 'edit'])->name('streetfood.edit');
        Route::put('/{id}', [StreetFoodController::class, 'update'])->name('streetfood.update');
        Route::delete('/{id}', [StreetFoodController::class, 'destroy'])->name('streetfood.destroy');
    });


    // Todolist david
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/david-todo-list', [DavidTodoListController::class, 'index'])->name('david-todo-list.index');
        Route::get('/david-todo-list/show', [DavidTodoListController::class, 'show'])->name('david-todo-list.show');
        Route::post('/david-todo-list', [DavidTodoListController::class, 'store'])->name('david-todo-list.store');
        Route::post('/david-todo-list/update', [DavidTodoListController::class, 'update'])->name('david-todo-list.update');
        Route::post('/david-todo-list/update-status', [DavidTodoListController::class, 'updateStatus'])->name('david-todo-list.update-status');
        Route::delete('/david-todo-list', [DavidTodoListController::class, 'destroy'])->name('david-todo-list.destroy');
    });
    
    // Todolist christine
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/christine-todo', [TodoListChristineController::class, 'index'])->name('todo.index');
        Route::post('/christine-todo', [TodoListChristineController::class, 'store'])->name('todo.store');
        Route::patch('/christine-todo/{todoListChristine}/status', [TodoListChristineController::class, 'updateStatus'])->name('todo.updateStatus');
        Route::delete('/christine-todo/{todoListChristine}', [TodoListChristineController::class, 'destroy'])->name('todo.destroy');
    });

    Route::get('/userlist', [Activity1Controller::class, 'index']);
});
Route::middleware('guest')->group(function (){
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});




