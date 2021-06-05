<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\CommerceQueueUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrentQueueController;
use App\Http\Controllers\QueueVerifiedUsersController;
use App\Http\Controllers\TestController;

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


//Secure middleware
// --not disabled :O
Route::middleware('auth:api')->group(function () {
    //All secure URL's
    //Header Authorization example :Authorization= "Bearer 9|EFV7swhyHN6VHvT0YV8f3L5MGgCCbkU53NTvGT4I" or "Bearer token"
    Route::apiResource('commerces',CommerceController::class);

    //add queue to queues
    //http://localhost/i-Queue-BackEnd/public/api/currentqueues
    Route::post('current-queues', [CurrentQueueController::class, 'store']);
    Route::get('current-queues', [CurrentQueueController::class, 'index']);

    //for testing purposes
    //http://localhost/i-Queue-BackEnd/public/api/queue_verified_users
    Route::get('queue-verified-users', [QueueVerifiedUsersController::class, 'index']);

    //add user to queue
    //http://localhost/i-Queue-BackEnd/public/api/queue_verified_users
    Route::post('queue-verified-users', [QueueVerifiedUsersController::class, 'store']);

    //delete user to queue
    //http://localhost/i-Queue-BackEnd/public/api/queue_verified_users
    Route::delete('queue-verified-users/{id}', [QueueVerifiedUsersController::class, 'destroy']);
    //check if user can enter establishment (tablet)
    Route::get('queue-verified-users-check/{userId}/{queueId}', [QueueVerifiedUsersController::class, 'entry_check']);
    //check unser info (phone)
    Route::get('queue-verified-users/{id}', [QueueVerifiedUsersController::class, 'info']);

    Route::apiResource('users',UserController::class)->only(['show','destroy']);

});

//AUTH login/register
Route::post("login", [UserController::class, 'login'])->name('login');
Route::post("register", [UserController::class, 'register']);
//Route::apiResource("testing",TestController::class);

