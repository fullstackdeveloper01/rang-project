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

Route::get('/', 'FrontEndController@index')->name('front');
Route::get('/home2', 'FrontEndController@index2')->name('home2');
Route::get('/manufacturer/{manufacturer_id}', 'FrontEndController@index3')->name('manufacturer.view');
Route::get('/image-vector/{image_id}', 'FrontEndController@view_image')->name('view_image');

//cart
Route::get('/view-cart', 'CartController@index')->name('view_cart');
Route::post('/cart-new', 'CartController@add')->name('cartnew');

//request
Route::get('/request', 'RequestController@index')->name('request');
Route::post('/user-request', 'RequestController@user_request')->name('user_request');
Route::get('/request/ticket/{request_id}', 'RequestController@ticket')->name('request.ticket'); 

Route::get('/'.env('URL_ROUTE','restaurant').'/{alias}', 'FrontEndController@restorant')->name('vendor');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); 
Route::group(['middleware' => 'auth'], function () {

    Route::get('/profile/images', 'FrontEndController@manufacturer_profile')->name('manufacturer.profile');  

    Route::name('admin.')->group(function () {
        Route::get('syncV1UsersToAuth0', 'SettingsController@syncV1UsersToAuth0')->name('syncV1UsersToAuth0');
        Route::get('dontsyncV1UsersToAuth0', 'SettingsController@dontsyncV1UsersToAuth0')->name('dontsyncV1UsersToAuth0');
        Route::resource('restaurants', 'RestorantController');
        Route::put('restaurants_app_update/{restaurant}', 'RestorantController@updateApps')->name('restaurant.updateApps');

        Route::get('restaurants_add_new_shift/{restaurant}', 'RestorantController@addnewshift')->name('restaurant.addshift');

        Route::get('restaurants/loginas/{restaurant}', 'RestorantController@loginas')->name('restaurants.loginas');

        Route::get('removedemodata', 'RestorantController@removedemo')->name('restaurants.removedemo');
        Route::get('sitemap','SettingsController@regenerateSitemap')->name('regenerate.sitemap');

        // Landing page settings 
        Route::get('landing', 'SettingsController@landing')->name('landing');
        Route::prefix('landing')->name('landing.')->group(function () {
            Route::resource('features', 'FeaturesController');
            Route::get('/features/del/{feature}', 'FeaturesController@destroy')->name('features.delete');

            Route::resource('testimonials', 'TestimonialsController');
            Route::get('/testimonials/del/{testimonial}', 'TestimonialsController@destroy')->name('testimonials.delete');

            Route::resource('processes', 'ProcessController');
            Route::get('/processes/del/{process}', 'ProcessController@destroy')->name('processes.delete');
        });

        Route::name('restaurant.')->group(function () {

            //Remove restaurant
            Route::get('removerestaurant/{restaurant}', 'RestorantController@remove')->name('remove');

            // Tables
            Route::get('tables', 'TablesController@index')->name('tables.index');
            Route::get('tables/{table}/edit', 'TablesController@edit')->name('tables.edit');
            Route::get('tables/create', 'TablesController@create')->name('tables.create');
            Route::post('tables', 'TablesController@store')->name('tables.store');
            Route::put('tables/{table}', 'TablesController@update')->name('tables.update');
            Route::get('tables/del/{table}', 'TablesController@destroy')->name('tables.delete');

            // Areas
            Route::resource('restoareas', 'RestoareasController');
            Route::get('restoareas/del/{restoarea}', 'RestoareasController@destroy')->name('restoareas.delete');

            // Areas
            Route::resource('visits', 'VisitsController');
            Route::get('visits/del/{visit}', 'VisitsController@destroy')->name('visits.delete');

            //Coupons
            Route::get('coupons', 'CouponsController@index')->name('coupons.index');
            Route::get('coupons/{coupon}/edit', 'CouponsController@edit')->name('coupons.edit');
            Route::get('coupons/create', 'CouponsController@create')->name('coupons.create');
            Route::post('coupons', 'CouponsController@store')->name('coupons.store');
            Route::put('coupons/{coupon}', 'CouponsController@update')->name('coupons.update');
            Route::get('coupons/del/{coupon}', 'CouponsController@destroy')->name('coupons.delete');

            Route::post('coupons/apply', 'CouponsController@apply')->name('coupons.apply');

            //Banners
            Route::get('banners', 'BannersController@index')->name('banners.index');
            Route::get('banners/{banner}/edit', 'BannersController@edit')->name('banners.edit');
            Route::get('banners/create', 'BannersController@create')->name('banners.create');
            Route::post('banners', 'BannersController@store')->name('banners.store');
            Route::put('banners/{banner}', 'BannersController@update')->name('banners.update');
            Route::get('banners/del/{banner}', 'BannersController@destroy')->name('banners.delete'); 
            //Language menu
            Route::post('storenewlanguage', 'RestorantController@storeNewLanguage')->name('storenewlanguage');
        });

    });

    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::post('/user/push', 'UserController@checkPushNotificationId');
    
    Route::resource('image', 'ImageControler');
    Route::resource('colors', 'ColorsController');
    Route::resource('designPatterns', 'DesignPatternsController');
    Route::post('/images/add-colors', 'ColorsController@storeNewOptions')->name('color.add_new');
    Route::post('/images/add-patterns', 'DesignPatternsController@storeNewOptions')->name('pattern.add_new');
    
    Route::get('/image/{image}/activate', 'ImageControler@activateImage')->name('image.activate');
    Route::get('/manufacturer-profile/{id}', 'ImageControler@manufacturer_profile')->name('manufacturer_profile');
    //bulk
    Route::get('/images/bulk-upload', 'ImageControler@addbulkImage')->name('image.addbulk');
    Route::post('/images/bulk-store', 'ImageControler@storebulkImage')->name('images.bulk_store');


    Route::any('/images/csv-upload', 'ImageControler@csvUploadImages')->name('image.csvupload');
    Route::post('/images/ajax-store', 'ImageControler@imageAjaxStore')->name('image.ajaxstore');


    Route::resource('restorants', 'RestorantController');
    Route::post('/updateres/location/{restorant}', 'RestorantController@updateLocation');
    Route::get('/get/rlocation/{restorant}', 'RestorantController@getLocation');
    Route::post('/updateres/radius/{restorant}', 'RestorantController@updateRadius');
    Route::post('/import/restaurants', 'RestorantController@import')->name('import.restaurants');
    Route::get('/restaurant/{restorant}/activate', 'RestorantController@activateRestaurant')->name('restaurant.activate');
    Route::post('/restaurant/workinghours', 'RestorantController@workingHours')->name('restaurant.workinghours');

    Route::get('/send-request', 'UserRequestController@send_request')->name('request.buyer');
    Route::get('/image-request', 'UserRequestController@index')->name('request.index');
    Route::get('/image-request/{id}', 'UserRequestController@view')->name('request.view');
    Route::get('/image-request/accept/{id}/{manuf_id}', 'UserRequestController@buyer_accept_request')->name('request_accept');
    Route::get('/image-request/{request_id}/{status}', 'UserRequestController@request_status')->name('request_status');

    Route::resource('buyer', 'BuyerController');
    Route::resource('manufacturer', 'ManufacturerController');
    Route::resource('drivers', 'DriverController');
    Route::resource('clients', 'ClientController');
    Route::resource('orders', 'OrderController');

    Route::get('ordertracingapi/{order}', 'OrderController@orderLocationAPI');
    Route::get('liveapi', 'OrderController@liveapi');

    Route::get('live', 'OrderController@live');
    Route::get('/updatestatus/{alias}/{order}', ['as' => 'update.status', 'uses'=>'OrderController@updateStatus']);

    Route::resource('settings', 'SettingsController');

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::resource('items', 'ItemsController');
    Route::get('/items/list/{restorant}', 'ItemsController@indexAdmin')->name('items.admin');
    Route::post('/import/items', 'ItemsController@import')->name('import.items');
    Route::post('/item/change/{item}', 'ItemsController@change');

    Route::resource('categories', 'CategoriesController');

    Route::resource('addresses', 'AddressControler');
    //Route::post('/order/address','AddressControler@orderAddress')->name('order.address');
    Route::get('/new/address/autocomplete','AddressControler@newAddressAutocomplete');
    Route::post('/new/address/details','AddressControler@newAdressPlaceDetails');

    Route::post('/change/{page}', 'PagesController@change')->name('changes');

    Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');
    Route::get('/payment','PaymentController@view')->name('payment.view');
    Route::post('/make/payment','PaymentController@payment')->name('make.payment');

    Route::get('/cart-checkout', 'CartController@cart')->name('cart.checkout');


});

Route::get('/footer-pages', 'PagesController@getPages');
Route::get('/cart-getContent', 'CartController@getContent')->name('cart.getContent');
Route::post('/cart-add', 'CartController@add')->name('cart.add');
Route::post('/cart-remove', 'CartController@remove')->name('cart.remove');
Route::get('/cart-update', 'CartController@update')->name('cart.update');
Route::get('/cartinc/{item}', 'CartController@increase')->name('cart.increase');
Route::get('/cartdec/{item}', 'CartController@decrease')->name('cart.decrease');


Route::post('/order', 'OrderController@store')->name('order.store');

Route::resource('pages', 'PagesController');

Route::get('/login/google', 'Auth\LoginController@googleRedirectToProvider')->name('google.login');
Route::get('/login/google/redirect', 'Auth\LoginController@googleHandleProviderCallback');

Route::get('/login/facebook', 'Auth\LoginController@facebookRedirectToProvider')->name('facebook.login');
Route::get('/login/facebook/redirect', 'Auth\LoginController@facebookHandleProviderCallback');

Route::get('/new/restaurant/register', 'RestorantController@showRegisterRestaurant')->name('newrestaurant.register');
Route::post('/new/restaurant/register/store', 'RestorantController@storeRegisterRestaurant')->name('newrestaurant.store');


