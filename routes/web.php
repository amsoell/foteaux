<?php

use App\Http\Controllers\FeedController;
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

Route::redirect('/', '/login');

Route::get('feed/{user:username}', [FeedController::class, 'show'])->name('profile');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('feed', [FeedController::class, 'index'])->name('feed');
    Route::view('upload', 'upload')->name('upload');
});
