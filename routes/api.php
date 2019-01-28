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
    Route::get('/student/{student_id}/payment', 'StudentController@payment');
    Route::get('/student/{student_id}/leave', 'StudentController@leave');

    // Route::post('/student/{student_id}/program', 'StudentController@add_program');
    // Route::post('/student/{student_id}/class/pivot/{pivot_id}/change_class', 'StudentController@change_class');
    // Route::post('/student/{student_id}/class/pivot/{pivot_id}/edit_date', 'StudentController@edit_date');
    // Route::delete('/student/{student_id}/class/pivot/{pivot_id}', 'StudentController@delete_class');

    Route::get('/class', 'ClassinfoController@list');
});

Route::middleware('auth:api')->prefix('program')->group(function(){
    Route::get('', 'ProgramController@list');
    Route::post('', 'ProgramController@store');
    Route::delete('{program_id}', 'ProgramController@destroy');

    Route::post('class', 'ProgramController@add_class');
    Route::post('class/{class_in_program_id}', 'ProgramController@change_class');
    Route::delete('class/{class_in_program_id}', 'ProgramController@destroy_class');

    Route::post('{program_id}/date', 'ProgramController@update_program_date');
    Route::post('date', 'ProgramController@update_programs_date');
});

Route::middleware('auth:api')->prefix('class_in_program')->group(function(){
    Route::post('{class_in_program_id}/edit/date', 'ClassInProgramController@edit_date');
    Route::post('{class_in_program_id}/complete', 'ClassInProgramController@complete_class');
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
    // Route::post('{invoice_id}/change_status', 'InvoiceController@change_status');
    Route::post('{invoice_id}/refund', 'InvoiceController@refund');
});

Route::middleware('auth:api')->prefix('payment')->group(function(){
    Route::get('', 'PaymentController@list');
    Route::post('', 'PaymentController@store');
    Route::delete('{payment_id}', 'PaymentController@destroy');
    Route::post('{payment_id}/change_status', 'PaymentController@change_status');
});

Route::middleware('auth:api')->prefix('leave')->group(function(){
    Route::post('', 'LeaveController@store');
    Route::put('{leave_id}', 'LeaveController@update');
    // Route::patch('')
    Route::delete('{leave_id}', 'LeaveController@destroy');
    Route::post('{leave_id}/program', 'LeaveController@attach_program');
    Route::delete('{leave_id}/program', 'LeaveController@detach_program');
});


Route::post('/refresh', 'AuthController@refresh');
Route::post('/login', 'AuthController@login');

Route::resource('test', 'TestController');

