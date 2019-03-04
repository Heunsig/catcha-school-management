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

Route::middleware('auth:api')->prefix('user')->group(function(){
    Route::get('', function (Request $request) {
        return $request->user();
    });

    Route::put('', 'UserController@update');

    Route::patch('password', 'UserController@change_password');
});

Route::middleware('auth:api')->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });

    Route::post('/logout', 'AuthController@logout');

    Route::get('/student', 'StudentController@list');
    Route::get('/student/register', 'StudentController@register');
    Route::post('/student', 'StudentController@store');
    Route::put('/student/{student_id}', 'StudentController@update');

    Route::get('/student/{student_id}/min', 'StudentController@min_infomation');
    Route::get('/student/{student_id}', 'StudentController@basic_information');
    Route::get('/student/{student_id}/contact', 'StudentController@contact');
    Route::get('/student/{student_id}/address', 'StudentController@address');
    Route::get('/student/{student_id}/emergency_contact', 'StudentController@emergency_contact');
    // Route::get('/student/{student_id}/contact', 'StudentController@contact');
    Route::get('/student/{student_id}/class', 'StudentController@class');
    Route::post('/student/{student_id}/class', 'StudentController@add_class');
    Route::get('/student/{student_id}/payment', 'StudentController@payment');
    Route::get('/student/{student_id}/leave', 'StudentController@leave');
    Route::get('/student/{student_id}/program_term', 'StudentController@program_term');

    // Route::post('/student/{student_id}/program', 'StudentController@add_program');
    // Route::post('/student/{student_id}/class/pivot/{pivot_id}/change_class', 'StudentController@change_class');
    // Route::post('/student/{student_id}/class/pivot/{pivot_id}/edit_date', 'StudentController@edit_date');
    // Route::delete('/student/{student_id}/class/pivot/{pivot_id}', 'StudentController@delete_class');

    Route::get('/class', 'ClassinfoController@list');
});

// Route::middleware('auth:api')->get('dashboard', 'DashboardController@index');
Route::middleware('auth:api')->prefix('selection_option')->group(function(){
    Route::get('student_status', 'SelectionOptionController@student_status');
    Route::get('country', 'SelectionOptionController@country');
});

Route::middleware('auth:api')->prefix('dashboard')->group(function(){
    Route::get('', 'DashboardController@index');
    Route::get('new_students', 'DashboardController@get_new_students');
    Route::get('coming_programs', 'DashboardController@get_coming_programs');
    Route::get('finishing_programs', 'DashboardController@get_finishing_programs');
    Route::get('coming_leaves', 'DashboardController@get_coming_leaves');
    Route::get('finishing_leaves', 'DashboardController@get_finishing_leaves');
    Route::get('leaves_today', 'DashboardController@get_leaves_today');
});

Route::middleware('auth:api')->prefix('program')->group(function(){
    Route::get('', 'ProgramController@list');
    Route::post('', 'ProgramController@store');
    Route::post('{program_id}/reset', 'ProgramController@reset');
    Route::delete('{program_id}', 'ProgramController@destroy');

    Route::post('class', 'ProgramController@add_class');
    Route::post('class/{class_in_program_id}', 'ProgramController@change_class');
    Route::delete('class/{class_in_program_id}', 'ProgramController@destroy_class');

    // Route::post('{program_id}/init_date', 'ProgramController@set_init_program_date');
    Route::post('{program_id}/date', 'ProgramController@update_program_date');
    Route::delete('{program_id}/date/{date_id}', 'ProgramController@destroy_program_date');
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
    Route::get('test', 'ProductController@test');
    // Route::get('{product_id}/attribute', 'ProductController@get_attribute');
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

Route::middleware('auth:api')->prefix('address')->group(function(){
    Route::post('', 'AddressController@store');
    Route::delete('{address_id}', 'AddressController@destroy');
    Route::put('{address_id}', 'AddressController@update');
});

Route::middleware('auth:api')->prefix('contact')->group(function(){
    Route::post('', 'ContactController@store');
    Route::delete('{contact_id}', 'ContactController@destroy');
});

Route::middleware('auth:api')->prefix('emergency_contact')->group(function(){
    Route::post('', 'EmergencyContactController@store');
    Route::put('{emergency_contact_id}', 'EmergencyContactController@update');
    Route::delete('{emergency_contact_id}', 'EmergencyContactController@destroy');
});

Route::middleware('auth:api')->prefix('setting')->group(function(){
    Route::get('', 'SettingController@index');
    Route::put('', 'SettingController@update');
});

Route::post('/refresh', 'AuthController@refresh');
Route::post('/login', 'AuthController@login');

Route::resource('test', 'TestController');

