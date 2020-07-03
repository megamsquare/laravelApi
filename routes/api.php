<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('login', 'AuthController@login');

    Route::post('createUser', 'AuthController@createUser');

    Route::post('logout', 'AuthController@logout');

    Route::post('refresh', 'AuthController@refresh');

    Route::post('me', 'AuthController@me');
    
    Route::post('sendPasswordReset', 'ResetPasswordController@sendEmail');

});
