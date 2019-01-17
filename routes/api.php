<?php

use Illuminate\Http\Request;
// use App\User;
// use App\Http\Resources\TestCollection;

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
    Route::get('/student/register', 'StudentController@register');
    Route::post('/student', 'StudentController@store');

    Route::get('/student/{student_id}/basic_information', 'StudentController@basic_information');
    Route::get('/student/{student_id}/class', 'StudentController@class');
    Route::post('/student/{student_id}/class', 'StudentController@add_class');
    Route::post('/student/{student_id}/class/pivot/{pivot_id}/change_class', 'StudentController@change_class');
    Route::post('/student/{student_id}/class/pivot/{pivot_id}/edit_date', 'StudentController@edit_date');
    Route::delete('/student/{student_id}/class/pivot/{pivot_id}', 'StudentController@delete_class');

    Route::get('/class', 'ClassinfoController@list');
});

Route::middleware('auth:api')->prefix('payment_method')->group(function(){ 
    Route::get('', 'PaymentMethodController@list');
});

Route::middleware('auth:api')->prefix('product')->group(function(){ 
    Route::get('', 'ProductController@list');
});


Route::middleware('auth:api')->prefix('invoice')->group(function(){ 
    Route::get('', 'InvoiceController@list');
    Route::post('', 'InvoiceController@add');
    Route::delete('{invoice_id}', 'InvoiceController@delete');
    Route::post('{invoice_id}/change_status', 'InvoiceController@change_status');
    Route::post('{invoice_id}/refund', 'InvoiceController@refund');

});


Route::post('/refresh', 'AuthController@refresh');
Route::post('/login', 'AuthController@login');



Route::get('/test', function(){
    // return TestCollection::collection(User::all());
});

