<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ResetPasswordWithPhoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public routes
Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[LoginController::class,'login']);
Route::post('password/forget-password-email',[ForgetPasswordController::class,'forgetPassword']);
Route::post('password/reset-with-email',[ResetPasswordController::class,'resetPassword']);
Route::post('forget-password-phone',[ResetPasswordWithPhoneController::class,'forgetPassword']);
Route::post('reset-with-phone',[ResetPasswordWithPhoneController::class,'resetPassword']);


//protected routes
Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::post('/logout',[LogoutController::class,'logout']);
});
