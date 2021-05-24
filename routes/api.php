<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrentqueueController;
use App\Http\Controllers\Queue_verified_users_controller;
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
    //Header Autorization example :Authorization= "Bearer 9|EFV7swhyHN6VHvT0YV8f3L5MGgCCbkU53NTvGT4I" or "Bearer token"
    //Listado negocios "/id para un negocio en concreto"
    //http://localhost/i-Queue-BackEnd/public/api/comerce/list
    Route::get('comerces/{id?}', [CommerceController::class, 'index']);
    //Cola del negocio
    //http://localhost/i-Queue-BackEnd/public/api/comerce/queue
    Route::get('comerce/queue/{id?}', [CommerceController::class, 'CurrentQueue']);

    //http://localhost/i-Queue-BackEnd/public/api/comerce
    Route::post('comerces', [CommerceController::class, 'store']);

    //add queue to queues
    //http://localhost/i-Queue-BackEnd/public/api/currentqueues
    Route::post('currentqueues', [CurrentqueueController::class, 'store']);

    //for testing purposes
    //http://localhost/i-Queue-BackEnd/public/api/queue_verified_users
    Route::get('queue_verified_users', [Queue_verified_users_controller::class, 'index']);

    //add user to queue
    //http://localhost/i-Queue-BackEnd/public/api/queue_verified_users
    Route::post('queue_verified_users', [Queue_verified_users_controller::class, 'store']);

    //delete user to queue
    //http://localhost/i-Queue-BackEnd/public/api/queue_verified_users
    Route::delete('queue_verified_users/{id}', [Queue_verified_users_controller::class, 'delete']);
    //check if user can enter establishment (tablet)
    Route::get('queue_verified_users_check/{id}', [Queue_verified_users_controller::class, 'entry_check']);
    //check unser info (phone)
    Route::get('queue_verified_users/{id}', [Queue_verified_users_controller::class, 'info']);



});

//AUTH login/register
Route::post("login", [UserController::class, 'login'])->name('login');
Route::post("register", [UserController::class, 'register']);

Route::apiResource("testing",TestController::class);

