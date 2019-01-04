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
Route::group(['namespace' => 'Backend', 'as' => 'backend.', 'prefix' => 'admin'], function () {
    Route::get('/','HomeController@index')->name('dashboard');
    Route::post('products/updateStatus','ProductController@updateStatus');
    Route::get('products/deleteImage/{$id}','ProductController@deleteImage')->name('del.product.image');
    Route::get('products/delete_product/{$product_id}','ProductController@deleteProduct')->name('del.product.product');
    Route::get('logout','Auth\LoginController@logout')->name('logout');
    Route::resource('products','ProductController',[
        'names' => [
            'index' => 'products',
            'store' => 'products.store',
            'update' => 'products.update'
        ]
    ]);
    Route::resource('category','CategoryController',[
        'names' => [
            'index' => 'category',
            'store' => 'category.store',
            'update' => 'category.update'
        ]
    ]);
    Route::group(['prefix' => 'json', 'as' => 'json.'], function (){
        Route::post('/filterByDate','HomeController@filterOrdersByDate');
        Route::get('/getSales','HomeController@getSalesLineChart');

    });

});


