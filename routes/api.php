<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('login', 'AuthController@login');

    Route::post('createUser', 'AuthController@createUser');

    Route::put('updateUser/{userId}', 'AuthController@updateUser');

    Route::put('changePassword/{userId}', 'AuthController@changePassword');

    Route::post('logout', 'AuthController@logout');

    Route::post('refresh', 'AuthController@refresh');

    Route::get('me', 'AuthController@me');

    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');

    Route::post('restPassword', 'ResetPasswordController@sendEmail');

});
