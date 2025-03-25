
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');

});




Route::middleware('auth:api')->group(function () {
    Route::get('/User', [UserController::class, 'index']);
    Route::post('/User', [UserController::class, 'store']);
    Route::get('/User/me', [UserController::class, 'show']);
    Route::put('/User', [UserController::class, 'update']);
    Route::delete('/User', [UserController::class, 'destroy']);
});

