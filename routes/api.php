<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Servicecontroller;

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

Route::group(['prefix' => 'v1'] ,  function()
{
    Route::post('transfare-gateway', [Servicecontroller::class , 'transfare_gateway']);
    Route::post('register', [Authcontroller::class , 'register']);
    Route::post('login', [Authcontroller::class , 'login']);
    Route::post('test', [Authcontroller::class , 'test']);

    Route::middleware(['auth:api' ])->group(function(){
    Route::post('transfare', [Servicecontroller::class , 'transfare']);
    });

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
