<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\Auth\ResetPasswordWithPhoneController;
use App\Http\Controllers\DoctorView2\ActivityPlaceController;
use App\Http\Controllers\DoctorView2\CowController;
use App\Http\Controllers\DoctorView2\EditUserDataController;
use App\Http\Controllers\DoctorView2\LogController;
use App\Http\Controllers\DoctorView2\PregnancyController;
use App\Http\Controllers\DoctorView2\SensorReadingController;
use App\Http\Controllers\DoctorView2\TreatmentController;
use App\Http\Controllers\DoctorView2\TreatmentDoseTimesController;

use App\Http\Controllers\DoctorView2\NoteController;
use App\Http\Controllers\DoctorView2\ActivitySysController;
use App\Http\Controllers\DoctorView2\BreedingSysController;



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
Route::group(['middleware'=>['auth:sanctum','isDoctor']],function (){
    Route::post('/logout',[LogoutController::class,'logout']);
    //cow routes
    Route::get('/cows',[CowController::class,'index']);
    Route::get('/cows/show/{id}',[CowController::class,'show']);
    Route::get('/cows/search',[CowController::class,'search']);
    Route::get('/cows/update/{id}',[CowController::class,'updateLocation']);
    Route::get('cows/filter-by-age',[CowController::class,'filterCowByAge']);
    Route::get('cows/filter-by-status',[CowController::class,'filterCowByStatus']);
    Route::get('cows/filter-by-status-with-search',[CowController::class,'filterCowByStatusWithSearch']);
    Route::get('cows/filter-by-age-with-search',[CowController::class,'filterCowByAgesWithSearch']);



    Route::get('/activity_places',[ActivityPlaceController::class,'index']);
    Route::get('/activity_places/{id}',[ActivityPlaceController::class,'show']);
    Route::get('/activity_place/search',[ActivityPlaceController::class,'searchPlace']);
    Route::get('activity_place/{activityPlace}/filter-by-cow-status',[ActivityPlaceController::class,'filterByCowStatus']);
    Route::get('activity_place/filter-by-type',[ActivityPlaceController::class,'filterByType']);
    Route::get('activity_place/search-with-filter',[ActivityPlaceController::class,'searchWithFilter']);



    Route::get('cow/{cow}/treatments/all',[TreatmentController::class,'index']);
    Route::get('cow/{cow}/treatments/show/{id}',[TreatmentController::class,'show']);
    Route::post('cow/{cow}/treatment/create',[TreatmentController::class,'create']);
    Route::post('treatment/{id}/edit',[TreatmentController::class,'edit']);
    Route::delete('treatment/delete/{treatment}',[TreatmentController::class,'delete']);
    Route::post('treatments/{treatment}/create-dose-times',[TreatmentDoseTimesController::class,'createDoseTime']);
    Route::post('treatments/{treatment}/edit-dose-times',[TreatmentDoseTimesController::class,'editDoseTime']);

    //sensor data
    Route::get('sensor',[SensorReadingController::class,'index']);
    Route::get('sensorRead',[SensorReadingController::class,'readingSensor']);

    //pregnancy
    Route::post('cow/{cow}/pregnant',[PregnancyController::class,'pregnantCow']);
    Route::post('cow/{cow}/born',[PregnancyController::class,'notPregnant']);


    Route::post('/setting/user/{id}',[EditUserDataController::class,'edit']);

    Route::get('log',[LogController::class,'index']);


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
    Route::get('/doc-activity-system/{activitySystem}/filter',[ActivitySysController::class,'filterByCowStatus']);
    Route::get('/doc-activity-system/filter-search',[ActivitySysController::class,'searchWithFilter']);
    Route::post('/activity-system/create',[ActivitySysController::class,'create']);
    Route::get('/activity-system/edit/{id}',[ActivitySysController::class,'edit']);
    Route::put('/activity-system/update/{id}',[ActivitySysController::class,'update']);


    Route::get('/doc-breeding-systems', [BreedingSysController::class, 'index']);
    Route::get('/doc-breeding-systems/{id}',[BreedingSysController::class,'show']);
    Route::get('/doc-breeding-system/search',[BreedingSysController::class,'search']);
    Route::get('/doc-breeding-system/{breadingSystem}/filter',[BreedingSysController::class,'filterByCowStatus']);
    Route::get('/doc-breeding-system/filter-search',[BreedingSysController::class,'searchWithFilter']);
    Route::post('/breeding-system/create',[BreedingSysController::class,'create']);
    Route::get('/breeding-system/edit/{id}',[BreedingSysController::class,'edit']);
    Route::put('/breeding-system/update/{id}',[BreedingSysController::class,'update']);


});


Route::get('/location',function (Request $request) {
    $ip = '156.197.167.0';; //Dynamic IP address
    $cowLocation = Location::get($ip);
    return response([
        'status' => true,
        'lan' => $cowLocation->latitude,
        'lag' => $cowLocation->longitude,
        'country' => $cowLocation->countryName,
        'city' => $cowLocation->cityName

    ]);
});

//    Route::get('/activity-systems', [ActivitySystemController::class, 'index']);
//    Route::get('/activity-systems/{id}',[ActivitySystemController::class,'show'])->name('show-asystem');
//    Route::get('/activity_systems/search',[ActivitySystemController::class,'search'])->name('find-asystem');
    //Route::get('/activity_systems/filter',[ActivitySystemController::class,'filter']);
   // Route::get('activity_System/{activitySystem}/filter-by-cow-status',[ActivitySystemController::class,'filterByCowStatus']);

//    Route::get('/breeding-systems', [BreedingSystemController::class, 'index']);
//    Route::get('/breeding-systems/{id}',[BreedingSystemController::class,'show'])->name('show-bsystem');
//    Route::get('/breeding_systems/search', [BreedingSystemController::class, 'search'])->name('find-bsystem');
//    Route::get('breeding_System/{breadingSystem}/filter-by-cow-status',[BreedingSystemController::class,'filterByCowStatus']);


//    Route::get('/cow-feed', [CowFeedController::class, 'index'])->name('show-bsystem');
//   // Route::get('/cow-feed/{id}', [CowFeedController::class, 'show-cowfeed']);
//
//   Route::get('/feed-stock', [FeedStockController::class, 'index'])->name('show-feedstock');
//    //Route::get('/feed-stock/{id}', [FeedStockController::class, 'show-feedstock']);





