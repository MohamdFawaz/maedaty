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
    Route::get('/test', function() {
        return File::get(public_path() . '/website/index.html');
    });

});
Route::group(['namespace' => 'Backend', 'as' => 'backend.', 'prefix' => 'admin'], function () {
    Route::get('/home',function (){
        redirect('admin');
    });
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
    Route::post('shop/updateStatus', 'ShopController@updateStatus')->name('shop.update.status');
    Route::get('shop/delete/{shop_id}', 'ShopController@destroy')->name('shop.delete');
    Route::resource('shop','ShopController',[
        'names' => [
            'index' => 'shop',
            'show' => 'shop.show',
            'edit' => 'shop.edit'
        ]
    ]);

    Route::get('shop_branch/delete/{branch_id}', 'ShopBranchController@destroy')->name('shop.branch.delete');
    Route::resource('shop_branch','ShopBranchController',[
        'names' => [
            'index' => 'shop_branch',
            'show' => 'shop_branch.show',
            'edit' => 'shop_branch.edit'
        ]
    ]);

    Route::resource('settings','SettingController');

    Route::post('message/get_messages','MessageController@listMessages')->name('list.messages');
    Route::post('message/send_message','MessageController@sendMessage')->name('send.messages');
    Route::resource('message','MessageController',[
        'names' => [
            'index' => 'message'
        ]
    ]);

    Route::post('user/updateStatus','UserController@updateStatus');
    Route::resource('user','UserController',[
    'names' => [
        'index' => 'user',
        'show' => 'user.show',
        'edit' => 'user.edit'
    ]
    ]);

    Route::get('admin_users/delete/{user_id}','AdminController@delete')->name('admin_users.delete');
    Route::resource('admin_users','AdminController',[
    'names' => [
        'index' => 'admin_users',
        'show' => 'admin.show',
        'edit' => 'admin.edit',
        'update' => 'admin.update',
        'create' => 'admin.create'
    ]
    ]);

    Route::get('notification/delete/{notification_id}','NotificationController@delete')->name('notification.delete');
    Route::resource('notification','NotificationController',[
    'names' => [
        'index' => 'notification',
        'show' => 'notification.show',
    ]
    ]);

    Route::get('promo/delete/{promo_id}','PromoCodeController@delete')->name('promo.delete');
    Route::post('promo/updateStatus','PromoCodeController@updateStatus');

    Route::resource('promo','PromoCodeController',[
    'names' => [
        'index' => 'promo',
        'show' => 'promo.show',
    ]
    ]);

    Route::group(['prefix' => 'json', 'as' => 'json.'], function (){
        Route::post('/filterByDate','HomeController@filterOrdersByDate');
        Route::get('/getSales','HomeController@getSalesLineChart');
        Route::get('/getMapCountries/{lat}/{lng}','HomeController@getMapCountries');

    });

});
});


