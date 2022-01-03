<?php
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

Route::namespace('Api')->group(function() {
    Route::post('/register', 'AuthenticateController@register');
    Route::post('/login', 'AuthenticateController@login');

    Route::prefix('v1')->middleware('auth:api')->group(function () {
        // 認証が必要なメソッド
        Route::post('/me', 'AuthenticateController@me');
        Route::post('/logout', 'AuthenticateController@logout');

        //userApiRoute
        Route::prefix('user')->group(function() {
            Route::post('/getProfile', 'UserController@getProfileAtUser');
            Route::post('/update', 'UserController@update');
            Route::post('/update_fist_name', 'UserController@updateUserFirstName');
            Route::post('/update_last_name', 'UserController@updateUserLastName');
            Route::post('/update_tel', 'UserController@updateUserTel');
            Route::post('/update_email', 'UserController@updateUserEmail');
            Route::post('/update_birthday', 'UserController@updateUserBirthday');
            Route::post('/update_comment', 'UserController@updateUserComment');
        });
    });
});
