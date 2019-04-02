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
    return view('auth.login');
});

Auth::routes();

Route::resource('students', 'StudentsController');

Route::get('subjects/create', 'SubjectsController@create');
Route::post('subjects', 'SubjectsController@store');
Route::get('subjects/{subject}', 'SubjectsController@show');
Route::get('subjects/{subject}/edit', 'SubjectsController@edit');
Route::put('subjects/{subject}', 'SubjectsController@update');
Route::delete('subjects/{subject}', 'SubjectsController@destroy');
