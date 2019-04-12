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

Route::get('exams/{student}', 'ExamsController@show');
Route::put('exams/{student}', 'ExamsController@reportExam');
Route::post('exams/{student}', 'ExamsController@storeMark');

Route::get('departments/create', 'DepartmentsController@create');
Route::post('departments', 'DepartmentsController@store');
Route::get('departments/{department}', 'DepartmentsController@show');
Route::get('departments/{department}/edit', 'DepartmentsController@edit');
Route::put('departments/{department}', 'DepartmentsController@update');
Route::delete('departments/{department}', 'DepartmentsController@destroy');
