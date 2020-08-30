<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'grades'], function(){
    Route::get('', 'GradeController@index')->name('grade.index');
    Route::get('create', 'GradeController@create')->name('grade.create');
    Route::post('store', 'GradeController@store')->name('grade.store');
    Route::get('edit/{grade}', 'GradeController@edit')->name('grade.edit');
    Route::post('update/{grade}', 'GradeController@update')->name('grade.update');
    Route::post('delete/{grade}', 'GradeController@destroy')->name('grade.destroy');
    Route::get('show/{grade}', 'GradeController@show')->name('grade.show');
 });

 Route::group(['prefix' => 'students'], function(){
    Route::get('', 'StudentController@index')->name('student.index');
    Route::get('create', 'StudentController@create')->name('student.create');
    Route::post('store', 'StudentController@store')->name('student.store');
    Route::get('edit/{student}', 'StudentController@edit')->name('student.edit');
    Route::post('update/{student}', 'StudentController@update')->name('student.update');
    Route::post('delete/{student}', 'StudentController@destroy')->name('student.destroy');
    Route::get('show/{student}', 'StudentController@show')->name('student.show');
 });

 Route::group(['prefix' => 'lectures'], function(){
    Route::get('', 'LectureController@index')->name('lecture.index');
    Route::get('create', 'LectureController@create')->name('lecture.create');
    Route::post('store', 'LectureController@store')->name('lecture.store');
    Route::get('edit/{lecture}', 'LectureController@edit')->name('lecture.edit');
    Route::post('update/{lecture}', 'LectureController@update')->name('lecture.update');
    Route::post('delete/{lecture}', 'LectureController@destroy')->name('lecture.destroy');
    Route::get('show/{lecture}', 'LectureController@show')->name('lecture.show');
 });