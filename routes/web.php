<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('users.index');
});

// User routes
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');

// Fallback route
Route::any('{any}', function () {
    return redirect()->route('users.index');
})->where('any', '.*');

