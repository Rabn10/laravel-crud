<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\CustomerController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class,'register']);
Route::post('login', [AuthController::class,'login']);

Route::group(['middleware'=>['auth:api']],function(){
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});

//Route::middleware('auth:api')->group(function ():void{
////   Route::post('customer','CustomerController@store');
//   Route::post('customer',[CustomerController::class,'store']);
//});

//Route::group(['middleware'=>['auth:api']],function ():void{
//    Route::post('customer',[CustomerController::class,'store']);
//});

//Route::post('customer',[CustomerController::class,'store'])->middleware('api');

//Route::apiResource('customer','CustomerController')->middleware('api');
//Route::middleware('auth:api')->apiResource('customer',[CustomerController]);

Route::middleware(['api'])->group(function () {
//    Route::apiResource('customer',CustomerController::class);
    Route::apiResource('customer',CustomerController::class);
});
