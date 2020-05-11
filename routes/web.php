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

Route::get('/search', 'HomeController@getSearch');


// Pages Static Custom
Route::get('page/{page}','PagesController@show')->where('page','[^/]*' );

Auth::routes();
Route::get('/user', 'UserController@index')->name('user');
Route::post('/user/add','UserController@storeBussDetails');

Route::get('/user/change-password', 'UserController@changePassword');
Route::post('/user/store-change-password','UserController@storeChangePassword');

Route::get('/user/manage-profile', 'UserController@manageProfile');
Route::post('/user/store-manage-profile','UserController@storeManageProfile');

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

	// Pages
	Route::resource('/admin/pages', 'PagesController', 
		['names' => [
		    'edit'    => 'pages.edit'
		 ]]
	);
	Route::get('/admin/pages/delete/{id}','PagesController@destroyPage')->where(array( 'id' => '[0-9]+'));

});
//<--- End Group Role
