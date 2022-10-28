<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::pattern('lotId','[0-9]+');
Route::group(['prefix'=>'lot'],function (){
    Route::get('/',[\App\Http\Controllers\Lot\LotController::class,'index']);
    Route::get('/{lotId}',[\App\Http\Controllers\Lot\LotController::class,'show']);
    Route::post('/',[\App\Http\Controllers\Lot\LotController::class,'store']);
    Route::post('/add-category/{lotId}',[\App\Http\Controllers\Lot\LotController::class,'addCategory']);
    Route::patch('/{lotId}',[\App\Http\Controllers\Lot\LotController::class,'update']);
    Route::delete('/{lotId}',[\App\Http\Controllers\Lot\LotController::class,'delete']);
});//lots

Route::group(['prefix'=>'category'],function (){
    Route::get('/',[\App\Http\Controllers\Lot\CategoryController::class,'index']);
    Route::get('/{catId}',[\App\Http\Controllers\Lot\CategoryController::class,'show']);
    Route::post('/',[\App\Http\Controllers\Lot\CategoryController::class,'store']);
    Route::patch('/{catId}',[\App\Http\Controllers\Lot\CategoryController::class,'update']);
    Route::delete('/{catId}',[\App\Http\Controllers\Lot\CategoryController::class,'delete']);
});


