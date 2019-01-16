<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//TODO use group in some of CRUD some routes
Route::post('test','api\AuthController@test');
Route::post('login', 'api\AuthController@login');
Route::post('fake_user', 'api\AuthController@tempUser');
Route::post('signup', 'api\AuthController@signup');
Route::get('category', 'api\CategoryController@index');
Route::get('subcategory', 'api\CategoryController@test');
Route::post('social_login', 'api\AuthController@socialLogin');
Route::get('product/{product_id}/{user_id?}', 'api\ProductController@show')
    ->where(['product_id' => '[0-9]+','user_id' => '[0-9]+']);
Route::get('product/list/{category_id}/{subcategory_id?}/{user_id?}', 'api\ProductController@index')
    ->where(['category_id' => '[0-9]+','subcategory_id' => '[0-9]+', 'user_id' => '[0-9]+']);
Route::get('user/favorite/{user_id}','api\UserFavoriteController@index');
Route::post('user/favorite/add_or_remove','api\UserFavoriteController@store');
Route::post('user/review/add','api\UserReviewController@store');
Route::post('user/cart/add_or_update','api\CartController@store');
Route::post('user/cart/delete','api\CartController@delete');
Route::get('user/cart/{user_id}','api\CartController@index')->where(['user_id' => '[0-9]+']);

//Address CRUD Routes
Route::group(['prefix' => 'user'], function (){
    Route::get('/address/{user_id}', 'api\AddressController@show')->where(['user_id' => '[0-9]+']);
    Route::post('/address', 'api\AddressController@store');
    Route::post('/address/edit', 'api\AddressController@edit');
    Route::post('/address/delete', 'api\AddressController@destroy');
});

//order CRUD Routes
Route::group(['prefix' => 'order'], function (){
    Route::get('/user/{user_id}', 'api\OrderController@orderInfo')->where(['user_id' => '[0-9]+']);
    Route::get('/user/list/{user_id}', 'api\OrderController@listOrder')->where(['user_id' => '[0-9]+']);
    Route::get('/{order_id}', 'api\OrderController@listOrderProducts')->where(['order_id' => '[0-9]+']);
    Route::post('/', 'api\OrderController@store');
});

//User Edit Profile Routes
Route::group(['prefix' => 'user'], function (){
    Route::get('/profile/{user_id}', 'api\ProfileController@show')->where(['user_id' => '[0-9]+']);
    Route::post('/profile/edit', 'api\ProfileController@edit');
    Route::post('/profile/change_password', 'api\ProfileController@changePassword');
});

