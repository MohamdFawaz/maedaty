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
