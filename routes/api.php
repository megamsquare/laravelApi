<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',

], function ($router) {
    Route::group(
        [
            'prefix' => 'auth'
        ],
        function () {

            Route::post('login', 'AuthController@login');

            Route::post('logout', 'AuthController@logout');

            Route::post('createUser', 'AuthController@createUser');

            Route::post('refresh', 'AuthController@refresh');

            Route::put('updateUser/{userId}', 'AuthController@updateUser');

            Route::put('changePassword/{userId}', 'AuthController@changePassword');

            Route::get('me', 'AuthController@me');

            Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');

            Route::post('restPassword', 'ChangePasswordController@resetPassword');
    });

    Route::group(
        [
            'prefix' => 'company'
        ],
        function () {

            Route::get('getAll', 'CompanyController@index');
    });


});
