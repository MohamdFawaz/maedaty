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
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/terms_and_conditions','TermsAndConditionsController@index');
    Route::get('/about_us','AboutUsController@index');
});
