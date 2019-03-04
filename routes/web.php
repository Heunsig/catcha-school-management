<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('pdf/{invoice_id}', 'InvoiceController@pdf_test');

Route::get('document/busletter', 'DocumentController@pdf_test');

// Route::resource('test', 'TestController');

// Route::get('/test', function () {
//     return view('welcome');
// })->middleware('test:test');