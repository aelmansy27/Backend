<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\Auth\ResetPasswordWithPhoneController;

use App\Http\Controllers\UserView\ActivityPlaceController;
use App\Http\Controllers\UserView\CowController;
use App\Http\Controllers\UserView\EditUserDataController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

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
    //cow routes
    Route::get('/cows',[CowController::class,'index']);
    Route::get('/cows/show/{id}',[CowController::class,'show'])->name('show_cow');
    Route::get('/cows/search',[CowController::class,'search'])->name('find_cow');
    Route::get('/cows/update/{id}',[CowController::class,'updateLocation']);
    Route::get('cows/filter-by-age',[CowController::class,'filterCowByAge']);
    Route::get('cows/filter-by-status',[CowController::class,'filterCowByStatus']);


    Route::get('/activity_places',[ActivityPlaceController::class,'index']);
    Route::get('/activity_places/{id}',[ActivityPlaceController::class,'show']);
    Route::get('/activity_place/search',[ActivityPlaceController::class,'searchPlace']);

    Route::post('/setting/user/{id}',[EditUserDataController::class,'edit']);
});


Route::get('/location',function (Request $request){
        $ip = '156.197.167.0';; //Dynamic IP address
        $cowLocation = Location::get($ip);
        return response([
            'status'=>true,
            'lan'=>$cowLocation->latitude,
            'lag'=>$cowLocation->longitude,
            'country'=>$cowLocation->countryName,
            'city'=>$cowLocation->cityName

    ]);
});
