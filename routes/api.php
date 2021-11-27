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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();

//});

Route::namespace('Api')->middleware('api')->group(function() {
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/login', 'AuthenticateController@authenticate');

    Route::middleware('jwt.auth')->prefix('v1')->group(function () {
        // 認証が必要なメソッド
    });
});
// Route::group(["middleware" => "guest:api"], function() {
//     Route::post('/login', 'AuthenticateController@authenticate');
// });
