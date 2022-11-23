<?php

use App\Http\Controllers\Bookmarks\DeleteController;
use App\Http\Controllers\Bookmarks\RedirectController;
use App\Http\Controllers\Bookmarks\StoreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('bookmarks')
    ->name('bookmarks.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/{bookmark}', RedirectController::class)->name('redirect');
        Route::post('/', StoreController::class)->name('store');
        Route::delete('/{bookmark}', DeleteController::class)->name('delete');
    });

Route::prefix('profile')
    ->name('profile.')
    ->middleware(['auth'])
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

require __DIR__ . '/auth.php';
