<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;

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

Route::middleware('auth')->get('/user', function (Request $request) {
    return UserResource::make($request->user());
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('bank', 'Api\BankController@index');

    Route::group(['prefix' => 'user'], function () {
        Route::get('currency', 'Api\User\CurrencyController@index');
        Route::post('currency/action', \Api\User\Currency\ActionController::class);
    });
});