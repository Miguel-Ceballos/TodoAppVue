<?php

use App\Http\Controllers\AllTasksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function() {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified' ])->group(callback : function() {
    Route::get('/dashboard', function() {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/{category:slug}/tasks', TaskController::class);
//    Route::resource('/inbox', AllTasksController::class);
    Route::resource('/statuses', StatusController::class);
    Route::get('/inbox', [AllTasksController::class, 'index'])->name('inbox.index');
    Route::post('/inbox', [AllTasksController::class, 'store'])->name('inbox.store');
    Route::delete('/inbox/{task:id}', [AllTasksController::class, 'destroy'])->name('inbox.destroy');
});


