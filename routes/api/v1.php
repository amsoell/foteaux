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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/feed', [ FeedController::class, 'index' ]);

    Route::prefix('/users/{user:username}')->group(function () {
        Route::get('', [ UserController::class, 'show' ]);
        Route::get('media', [ UserMediaController::class, 'index' ]);

        Route::get('follow', [ UserFollowController::class, 'store' ]);
        Route::delete('follow', [ UserFollowController::class, 'delete' ]);
    });
});
