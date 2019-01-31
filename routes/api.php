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
Route::post('activate', 'api\AuthController@activateAccount');
Route::post('forgot_password', 'api\AuthController@forgotPassword');


Route::post('user/review/add','api\UserReviewController@store');

//Address CRUD Routes
Route::group(['prefix' => 'user'], function (){
    Route::get('/address/{user_id}', 'api\AddressController@show')->where(['user_id' => '[0-9]+']);
    Route::post('/address', 'api\AddressController@store');
    Route::post('/address/edit', 'api\AddressController@edit');
    Route::post('/address/delete', 'api\AddressController@destroy');
});

//Favorite CRUD Routes
Route::group(['prefix' => 'user'], function (){
    Route::get('/favorite/{user_id}','api\UserFavoriteController@index');
    Route::post('/favorite/add_or_remove','api\UserFavoriteController@store');
});

//Suggestion CRUD Routes
Route::group(['prefix' => 'suggestion'], function (){
    Route::post('/add','api\SuggestionController@store');
});

//Cart CRUD Routes
Route::group(['prefix' => 'user'], function (){
    Route::post('cart/add_or_update','api\CartController@store');
    Route::post('cart/delete','api\CartController@delete');
    Route::get('cart/{user_id}','api\CartController@index')->where(['user_id' => '[0-9]+']);
});

//Order CRUD Routes
Route::group(['prefix' => 'order'], function (){
    Route::get('/user/{user_id}', 'api\OrderController@orderInfo')->where(['user_id' => '[0-9]+']);
    Route::get('/user/list/{user_id}', 'api\OrderController@listOrder')->where(['user_id' => '[0-9]+']);
    Route::get('/{order_id}', 'api\OrderController@listOrderProducts')->where(['order_id' => '[0-9]+']);
    Route::post('/', 'api\OrderController@store');
});

//User profile Routes
Route::group(['prefix' => 'user'], function (){
    Route::get('/profile/{user_id}', 'api\ProfileController@show')->where(['user_id' => '[0-9]+']);
    Route::post('/profile/edit', 'api\ProfileController@edit');
    Route::post('/profile/change_password', 'api\ProfileController@changePassword');
    Route::post('/profile/change_lang', 'api\ProfileController@changeLanguage');
    Route::post('/profile/logout', 'api\ProfileController@logout');
});

//Product Routes
Route::group(['prefix' => 'product'], function (){
    Route::get('/{product_id}/{user_id?}', 'api\ProductController@show')
        ->where(['product_id' => '[0-9]+','user_id' => '[0-9]+']);
    Route::get('/list/{category_id}/{subcategory_id?}/{user_id?}/{cart_item_item?}', 'api\ProductController@index')
        ->where(['category_id' => '[0-9]+','subcategory_id' => '[0-9]+', 'user_id' => '[0-9]+','cart_item_item' => '[0-9]+']);
    Route::get('/offers/{user_id?}', 'api\ProductController@hotOffers')->where(['user_id' => '[0-9]+']);
    Route::get('/shop/{shop_id}/{user_id?}', 'api\ProductController@getShopProducts')->where(['shop_id' => '[0-9]+','user_id' => '[0-9]+']);
    Route::get('/search/{search_string}/{user_id?}', 'api\ProductController@searchForProducts')->where(['user_id' => '[0-9]+']);
});

//Notifications Routes
Route::group(['prefix' => 'notification'], function (){
    Route::get('/list/{user_id?}', 'api\NotificationController@index')
        ->where(['user_id' => '[0-9]+']);
    Route::post('/', 'api\NotificationController@store');
});

//Promo Routes
Route::group(['prefix' => 'promo'], function (){
    Route::post('/apply', 'api\PromoCodeController@store');
});

//Point Routes
Route::group(['prefix' => 'point'], function (){
    Route::post('/redeem', 'api\UserPointController@store');
});

//Shop Routes
Route::group(['prefix' => 'shop'], function (){
    Route::get('/list', 'api\ShopController@index');
    Route::get('/branch/{shop_id}', 'api\ShopController@shopBranches')->where(['shop_id' => '[0-9]+']);
});

