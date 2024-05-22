<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserView\ActivityPlaceController;
use App\Http\Controllers\UserView\CowController;
use App\Http\Controllers\UserView\ActivitySystemController;
use App\Http\Controllers\UserView\BreedingSystemController;
use App\Http\Controllers\UserView\CowFeedController;
use App\Http\Controllers\UserView\FeedStockController;
use App\Http\Controllers\DoctorView2\NoteController;
use App\Http\Controllers\DoctorView2\ActivitySysController;
use App\Http\Controllers\DoctorView2\BreedingSysController;


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
Route::post('password/forget-password',[ForgetPasswordController::class,'forgetPassword']);
Route::post('password/reset',[ResetPasswordController::class,'resetPassword']);

//protected routes
Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::post('/logout',[LogoutController::class,'logout']);
    //cow routes
    Route::get('/cows',[CowController::class,'index']);
    Route::get('/cows/show/{id}',[CowController::class,'show'])->name('show_cow');
    Route::get('/cows/search',[CowController::class,'search'])->name('find_cow');

    Route::get('/activity_places',[ActivityPlaceController::class,'index']);
    Route::get('/activity_places/{id}',[ActivityPlaceController::class,'show']);

    Route::get('/activity-systems', [ActivitySystemController::class, 'index']);
    Route::get('/activity-systems/{id}',[ActivitySystemController::class,'show'])->name('show-asystem');
    Route::get('/activity_systems/search',[ActivitySystemController::class,'search'])->name('find-asystem');
    //Route::get('/activity_systems/filter',[ActivitySystemController::class,'filter']);
    Route::get('activity_System/{activitySystem}/filter-by-cow-status',[ActivitySystemController::class,'filterByCowStatus']);

    Route::get('/breeding-systems', [BreedingSystemController::class, 'index']);
    Route::get('/breeding-systems/{id}',[BreedingSystemController::class,'show'])->name('show-bsystem');
    Route::get('/breeding_systems/search', [BreedingSystemController::class, 'search'])->name('find-bsystem');
    Route::get('breeding_System/{breadingSystem}/filter-by-cow-status',[BreedingSystemController::class,'filterByCowStatus']);


    Route::get('/cow-feed', [CowFeedController::class, 'index'])->name('show-bsystem');
   // Route::get('/cow-feed/{id}', [CowFeedController::class, 'show-cowfeed']);

   Route::get('/feed-stock', [FeedStockController::class, 'index'])->name('show-feedstock');
    //Route::get('/feed-stock/{id}', [FeedStockController::class, 'show-feedstock']);

    Route::middleware('auth:sanctum')->get('/doctor', function (Request $request) {
        return $request->doctor();
    });


    Route::get('/notes',[NoteController::class,'index']);
    Route::get('/notes/{id}',[NoteController::class,'show']);
    Route::post('/store',[NoteController::class,'store']);
    Route::get('/edit/{id}',[NoteController::class,'edit']);
    Route::put('/edit/{id}',[NoteController::class,'update']);
    Route::delete('/delete/{id}',[NoteController::class,'destroy']);
    Route::post('/notes/{id}/star', [NoteController::class, 'star']);
    Route::post('/notes/{id}/unstar', [NoteController::class, 'unstar']);

    Route::get('/doc-activity-systems', [ActivitySysController::class, 'index']);
    Route::get('/doc-activity-systems/{id}',[ActivitySysController::class,'show']);
    Route::get('/doc-activity-system/search',[ActivitySysController::class,'search']);
    Route::get('/doc-activity-system/filter-search',[ActivitySysController::class,'searchWithFilter']);
    Route::post('/activity-system/create',[ActivitySysController::class,'create']);
    Route::get('/activity-system/edit/{id}',[ActivitySysController::class,'edit']);
    Route::put('/activity-system/update/{id}',[ActivitySysController::class,'update']);


    Route::get('/doc-activity-systems', [\App\Http\Controllers\DoctorView2\BreedingSysController::Controller::class, 'index']);
    Route::get('/doc-activity-systems/{id}',[ActivitySysController::class,'show']);
    Route::get('/doc-activity-system/search',[ActivitySysController::class,'search']);
    Route::get('/doc-activity-system/filter-search',[ActivitySysController::class,'searchWithFilter']);
    Route::post('/activity-system/create',[ActivitySysController::class,'create']);
    Route::get('/activity-system/edit/{id}',[ActivitySysController::class,'edit']);
    Route::put('/activity-system/update/{id}',[ActivitySysController::class,'update']);






});
