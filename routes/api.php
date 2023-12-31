<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index');
    Route::post('users', 'store');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
