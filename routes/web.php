<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Auth::routes();
/*
Route::view('/{any}', 'home')
    ->middleware(['auth'])
    ->where('any', '.*');
*/

Route::get('/', function () {
    return view('home');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/home/', 'index')->name('home');
    Route::get('/sorts', 'sorts')->name('sorts');
    Route::get('/clients', 'clients')->name('clients');
    Route::get('/plants', 'plants')->name('plants');
    Route::get('/misc', 'misc')->name('misc');
    Route::get('/stand', 'stand')->name('stand');
    Route::get('/task', 'task')->name('task');
});

Route::prefix('admin')->group(
    function () {
        Route::get('dashboard',[App\Http\Controllers\AdminController::class, 'index'])->name('admin') ;
        Route::get('tree',[App\Http\Controllers\AdminController::class, 'tree'])->name('tree') ;
    }
);



