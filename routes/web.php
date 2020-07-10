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
Route::get('/', 'HomeController@index');
Route::get('home', function(){
	return redirect('/');
});


Route::get('/qr-test', 'OrderController@index');

Route::get('/search', 'HomeController@getSearch');
Route::get('/store-detail/{id}', 'OrderController@storeDetail');

Route::get('/fill-order-details/{id}', 'OrderController@fillOrderDetails');
Route::post('/order/add', 'OrderController@store');
//Route::get('/order/make-payment/{id}', 'OrderController@makePayment');
Route::get('/order/make-payment/{id}', 'OrderController@makeIntent');
Route::post('/order/add-payment', 'OrderController@storePayment');
Route::get('/order/thank-you/{id}', 'OrderController@thankYou');
// Pages Static Custom
Route::get('page/{page}','PagesController@show')->where('page','[^/]*' );

Auth::routes();
Route::get('/user', 'UserController@index')->name('user');
Route::post('/user/add','UserController@storeBussDetails');

Route::get('/user/change-password', 'UserController@changePassword');
Route::post('/user/store-change-password','UserController@storeChangePassword');

Route::get('/user/manage-profile', 'UserController@manageProfile');
Route::post('/user/store-manage-profile','UserController@storeManageProfile');

Route::get('/user/add-business', 'UserController@addBusiness');
Route::post('/user/store-add-business','UserController@storeAddBusiness');
Route::get('/user/businesses', 'UserController@businessList');
Route::get('/user/edit-business/{id}', 'UserController@editBusiness');
Route::post('/user/store-edit-business','UserController@storeEditBusiness');

Route::get('/user/orders', 'UserController@ordersList');
Route::get('/user/order-detail/{id}', 'UserController@orderDetail');
Route::get('/user/generate-qrcode/{id}','UserController@generateQrcode');
Route::get('/user/redeem-order','UserController@redeemOrder');

Route::get('/user/redeem-amount/{id}/{amount}','UserController@redeemAmount');

Route::post('/user/redeem-order-ajax','UserController@redeemOrderAjax');
Route::post('/user/transaction-order-ajax','UserController@AllOrderTransactionsAjax');

Route::get('/user/stripe-authorization', 'UserController@stripeAuthorization');
Route::get('/user/stripe-deauthorization/{id}', 'UserController@stripeDeauthorization');

Route::post('/user/newsletter-email','HomeController@newsLetterSave');

//Admin Routes

Route::group(['middleware' => 'admin'], function() {

	Route::get('/admin/dashboard', 'AdminController@index');

	// Admin Profile
	Route::get('/admin/profile','AdminController@profile');
	Route::post('/admin/profile/add','AdminController@storeProfile');

	// Admin change Password
	Route::get('/admin/change-password','AdminController@changePassword');
	Route::post('/admin/change-password/update','AdminController@storePassword');

	// Admin users management
	Route::get('/admin/users-list','AdminController@usersList');
	Route::get('/admin/users-list/edit/{id}','AdminController@editUsers')->where(array( 'id' => '[0-9]+'));
	Route::post('/admin/users-list/update','AdminController@updateUsers');
	Route::get('/admin/users-list/delete/{id}','AdminController@deleteUser')->where(array( 'id' => '[0-9]+'));

	Route::get('/admin/businesses-list','AdminController@businessList');
	Route::get('/admin/businesses-list/edit/{id}','AdminController@editBusiness')->where(array( 'id' => '[0-9]+'));
	Route::post('/admin/businesses-list/update','AdminController@updateBusiness');
	// Pages
	Route::resource('/admin/pages', 'PagesController', 
		['names' => [
		    'edit'    => 'pages.edit'
		 ]]
	);
	Route::get('/admin/pages/delete/{id}','PagesController@destroyPage')->where(array( 'id' => '[0-9]+'));

	// Admin ordes management
	Route::get('/admin/orders-list','AdminController@ordersList');
	Route::get('/admin/order-detail/{id}','AdminController@orderDetail');
	Route::get('/admin/generate-qrcode/{id}','AdminController@generateQrcode');
	Route::get('/admin/order-transactions/{id}','AdminController@orderTransactions');

	Route::get('/admin/commission-settings','AdminController@commissionSettings');
	Route::post('/admin/commission-settings/update','AdminController@updateCommissionSettings');
	Route::get('/admin/profile-socials','AdminController@profileSocials');
	Route::post('/admin/profile-socials/update','AdminController@updateSocialSettings');
	Route::get('/admin/news-letters','AdminController@newsLetters');
	
	Route::post('/admin/business-isfeatured','AdminController@isFeatured');
});
//<--- End Group Role
