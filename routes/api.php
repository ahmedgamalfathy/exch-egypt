<?php

use App\Http\Controllers\API\AgendaController;
use App\Http\Controllers\API\SectorController;
use App\Http\Controllers\API\StrategiesControler;
use App\Http\Controllers\API\PrivacyController;
use App\Http\Controllers\API\SFreeController;
use App\Http\Controllers\API\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\API\StokController;
use App\Http\Controllers\API\NewstokController;
use App\Http\Controllers\API\Auth\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('mobile')->group(function () {
    //authentcation
    Route::controller(UserController::class)->group(function(){
        Route::post('/register','register');
        Route::post('/login','login');
        Route::post('/verifyPhoneCode/{phone}','verifyPhoneCode');
        Route::post('/resendCode/{phone}','resendCode');
        Route::post('/resetPassword/{phone}','resetPassword');
        Route::post('/getAuthUser','getAuthUser')->middleware('auth:sanctum');
        Route::post('/logout','logout')->middleware('auth:sanctum');
        Route::post('/update_profile','update_profile')->middleware('auth:sanctum');
    });
    Route::controller(StokController::class)->group(function(){
        Route::get('/stoks','index');
        Route::get('/stoks/{id}','show');
        Route::post('/stoks','store');
        Route::patch('/stoks/{id}/update','update');
        Route::delete('/stoks/{id}/delete','destroy');
    });
    Route::controller(NewstokController::class)->group(function(){
        Route::get('/news','index');
        Route::get('/news/{id}','show');
        Route::post('/news','store');
        Route::patch('/news/{id}/update','store');
        Route::delete('/news/{id}/delete','destroy');
    });
    Route::controller(SectorController::class)->group(function(){
        Route::get('/sectors','index');
        Route::get('/sectors/{id}','show');
        Route::post('/sectors','store');
        Route::delete('/sectors/{id}','destroy');
    });
    Route::controller(AgendaController::class)->group(function(){
        Route::get('/agendas','index');
        Route::get('/agendas/{id}','show');
        Route::post('/agendas','store');
    });
    Route::controller(StrategiesControler::class)->group(function(){
        Route::get('/daily','daily')->middleware('custom_auth');
        Route::get('/scalping','scalping')->middleware('custom_auth');
        Route::get('/swing','swing')->middleware('custom_auth');
        Route::get('/positions','positions')->middleware('custom_auth');
    });
    Route::controller(WalletController::class)->group(function(){
        Route::get('/wallet','index')->middleware('auth:sanctum');
        Route::get('/wallet/{id}','show')->middleware('auth:sanctum');
        Route::post('/wallet','store')->middleware('auth:sanctum');
        Route::post('/wallet_update/{id}','update')->middleware('auth:sanctum');
        Route::delete('/wallet_delete/{id}','destroy')->middleware('auth:sanctum');
    });
    Route::controller(SFreeController::class)->group(function(){
        Route::get('/sfree','index');
    });
    Route::controller(PrivacyController::class)->group(function(){
       Route::get('/privacy','index');
    });
    Route::get('/stoks/{slug}/reports',[FilterController::class,'filterReports']);

});
