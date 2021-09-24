<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'BankController@index');

Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    Route::get('currency', 'CurrencyController@index')->name('currency.index');
    Route::post('currency/action', \Currency\ActionController::class)->name('currency.action');
});

Auth::routes();
