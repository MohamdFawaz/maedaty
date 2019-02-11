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


Route::get('/welcome', function () {
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
    Route::Auth();
    Route::group(["middleware" => "auth"], function () {

    Route::get('/','HomeController@index')->name('dashboard');
    Route::post('products/updateStatus','ProductController@updateStatus');
    Route::get('products/deleteImage/{$id}','ProductController@deleteImage')->name('del.product.image');
    Route::get('products/delete_product/{$product_id}','ProductController@deleteProduct')->name('del.product.product');
    Route::get('logout','Auth\LoginController@logout')->name('logout');
    Route::get('category/delete/{category_id}','CategoryController@destroy')->name('category.delete');
    Route::get('subcategory/delete/{subcategory_id}','SubCategoryController@destroy')->name('subcategory.delete');
    Route::get('review/delete/{review_id}','UserReviewsController@destroy')->name('review.delete');
    Route::get('product/deleteImage/{product_id}','ProductController@deleteImage')->name('product.delete.image');
    Route::get('product/delete/{product_id}','ProductController@destroy')->name('product.delete');
    Route::get('suggestion/delete/{sug_id}','SuggestionController@destroy')->name('suggestion.delete');
    Route::post('order/change','OrderController@changeOrderStatus')->name('change.order.address');
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
    Route::resource('subcategory','SubCategoryController',[
        'names' => [
            'index' => 'subcategory',
            'store' => 'subcategory.store',
            'update' => 'subcategory.update'
        ]
    ]);
    Route::resource('order','OrderController',[
        'names' => [
            'index' => 'order',
            'store' => 'order.store',
            'update' => 'order.update'
        ]
    ]);
    Route::resource('review','UserReviewsController',[
        'names' => [
            'index' => 'review'
        ]
    ]);
    Route::resource('suggestion','SuggestionController',[
        'names' => [
            'index' => 'suggestion',
            'show' => 'suggestion.show'
        ]
    ]);
    Route::resource('settings','SettingController');

    Route::group(['prefix' => 'json', 'as' => 'json.'], function (){
        Route::post('/filterByDate','HomeController@filterOrdersByDate');
        Route::get('/getSales','HomeController@getSalesLineChart');

    });

});
});


