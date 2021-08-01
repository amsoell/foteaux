<?php

use App\Http\Controllers\Api\FeedController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserFollowController;
use App\Http\Controllers\Api\UserMediaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->name('api.v1.')->group(function () {
    Route::get('/feed', [ FeedController::class, 'index' ])->name('feed');

    Route::prefix('/users/{user:username}')->name('user.')->group(function () {
        Route::get('', [ UserController::class, 'show' ])->name('show');
        Route::patch('', [ UserController::class, 'update' ])->name('update');

        Route::get('media', [ UserMediaController::class, 'index' ])->name('media');

        Route::post('follow', [ UserFollowController::class, 'store' ])->name('follow.store');
        Route::delete('follow', [ UserFollowController::class, 'delete' ])->name('follow.delete');
    });
});
