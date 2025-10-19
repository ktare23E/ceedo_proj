<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TreasuryController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard',function(){
    return Inertia::render('Admin/Dashboard');
})->name('dashboard');

Route::get('/users',[UserController::class,'index'])->name('users');
Route::get('/create_user',[UserController::class,'create'])->name('create_user');
Route::post('/store_staff',[UserController::class,'store'])->name('store_staff');
Route::get('/edit_user/{user}',[UserController::class,'edit'])->name('edit_user');
Route::post('/update_staff',[UserController::class,'update'])->name('update_staff');

Route::get('/treasury',[TreasuryController::class,'index'])->name('treasury');
Route::get('/create_treasury',[TreasuryController::class,'create'])->name('create_treasury');
Route::post('/store_treasury',[TreasuryController::class,'store'])->name('store_treasury');
Route::get('/edit_treasury/{user}',[TreasuryController::class,'edit'])->name('edit_treasury');
Route::post('/update_treasury',[TreasuryController::class,'update'])->name('update_treasury');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
