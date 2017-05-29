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

Route::get('/', 'InvoiceController@index');

Route::get('/add', 'InvoiceController@add');

Route::put('/create', 'InvoiceController@create');

Route::get('/edit/{id}', 'InvoiceController@edit');

Route::post('/update/{id}', 'InvoiceController@update');

Route::post('/search', 'InvoiceController@search');

Route::delete('/delsearch/{id}', 'InvoiceController@delsearch');

Route::delete('/delete/{id}','InvoiceController@remove');

Route::get('pdf/{id}',array('as'=>'pdfview','uses'=>'InvoiceController@pdfview'));