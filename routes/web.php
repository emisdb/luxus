<?php

use App\Http\Controllers\NoveoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;

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

Route::get('/ele', function () {
    return view('element.message');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/home/', 'index')->name('home');
    Route::get('/sorts', 'sorts')->name('sorts');
    Route::get('/clients', 'clients')->name('clients');
    Route::get('/plants', 'plants')->name('plants');
    Route::get('/misc', 'misc')->name('misc');
    Route::get('/search', 'search')->name('search');
    Route::get('/stand', 'stand')->name('stand');
    Route::get('/task', 'task')->name('task');
    Route::get('/mail', 'mail')->name('mail');
    Route::get('/hic/{any?}', 'vue')->where('any', '.*')->name('hic');
});

Route::get('/noveo/{any?}', [NoveoController::class, 'index'])->where('any', '.*')->name('noveo');

Route::prefix('admin')->group(
    function () {
        Route::get('dashboard',[App\Http\Controllers\AdminController::class, 'index'])->name('admin') ;
        Route::get('tests',[App\Http\Controllers\HomeController::class, 'index'])->name('admin.home') ;
        Route::get('tree',[App\Http\Controllers\AdminController::class, 'tree'])->name('tree') ;
    }
);

Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('payment.pay');
Route::get('/payment/status', [PaymentController::class, 'status'])->name('payment.status');




