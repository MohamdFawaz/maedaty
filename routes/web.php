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
    Route::resource('message','MessageController');
    Route::get('login','LoginController@showLogin');
    Route::post('login','LoginController@login');

});
Route::group(['namespace' => 'Backend', 'as' => 'backend.','prefix' => 'admin'], function () {
    Route::get('/','HomeController@index');
    Route::resource('products','ProductController');
    Route::group(['prefix' => 'json'], function (){
        Route::post('/filterByDate','HomeController@filterOrdersByDate');
        Route::get('/getSales','HomeController@getSalesLineChart');

    });

});


