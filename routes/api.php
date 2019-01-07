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
