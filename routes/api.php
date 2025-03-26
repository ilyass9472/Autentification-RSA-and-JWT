
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Api\HackathonController;
use App\Models\User;
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
});
Route::middleware(['auth:JWT'])->group(function () {
    Route::post('/hackathons', [HackathonController::class, 'store']);  
    Route::get('/themes', [HackathonController::class, 'getThemes']);
});
Route::get('qrcode-with-image', function () {

  

    $image = QrCode::format('png')

                     ->merge(public_path('images/1644463030.png'), 0.5, true)

                     ->size(500)

                     ->errorCorrection('H')

                     ->generate('A simple example of QR code!');



    return response($image)->json([
        'Content-type'=>$user,
        'image/png']);

});



Route::middleware('auth:api')->group(function () {
    Route::get('/User', [UserController::class, 'index']);
    Route::post('/User', [UserController::class, 'store']);
    Route::get('/User/me', [UserController::class, 'show']);
    Route::put('/User', [UserController::class, 'update']);
    Route::delete('/User', [UserController::class, 'destroy']);
});

