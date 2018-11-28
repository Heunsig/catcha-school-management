<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', 'AuthController@logout');

    Route::get('/category/student_status', 'CategoryController@student_status');

    Route::get('/student', 'StudentController@list');
    Route::post('/student', 'StudentController@store');

    Route::get('/student/{student_id}/basic_information', 'StudentController@basic_information');
    Route::get('/student/{student_id}/class', 'StudentController@class');

    Route::get('/class', 'ClassinfoController@list');
});


Route::post('/refresh', 'AuthController@refresh');
Route::post('/login', 'AuthController@login');

