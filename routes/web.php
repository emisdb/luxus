<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->group(
    function () {
        Route::get('dashboard',[App\Http\Controllers\AdminController::class, 'index'])->name('admin') ;
        Route::get('tree',[App\Http\Controllers\AdminController::class, 'tree'])->name('tree') ;
    }
);



