<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});
Route::get('/user', function () {
    return view('auth.user');
});


Auth::routes();
Route::post('/regsiter_company', 'Auth\RegisterController@register')->name('register.compnay');
Route::post('/language', 'Admin\LanguageController@changeLanguage')->name('changeLanguage')->middleware('web');

Route::group([
    'middleware'    => ['auth'],
    'prefix'        => 'client',
    'namespace'     => 'Client'
], function ()
{
    Route::get('/dashboard', 'ClientController@index')->name('client.dashboard');
	Route::get('/profile', 'ClientController@edit')->name('client-profile');
	Route::post('/admin-update', 'ClientController@update')->name('client-update');



});

Route::group([
    'middleware'    => ['is_admin'],
    'prefix'        => 'admin',
    'namespace'     => 'Admin'
], function ()
{

    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@edit')->name('admin-profile');
    Route::post('/admin-update', 'AdminController@update')->name('admin-update');
    //Setting Routes
    Route::resource('setting','SettingController');

	//Staff Routes
	Route::resource('clients','ClientController');
	Route::post('get-clients', 'ClientController@getClients')->name('admin.getClients');
	Route::post('get-client', 'ClientController@clientDetail')->name('admin.getClient');
	Route::get('client/delete/{id}', 'ClientController@destroy');
	Route::post('delete-selected-clients', 'ClientController@deleteSelectedClients')->name('admin.delete-selected-clients');

    //User
    Route::resource('users','UserController');
	Route::post('get-users', 'UserController@getUser')->name('admin.getUsers');
    Route::post('get-users-contracts', 'UserController@getUserContracts')->name('admin.getUsersContracts');
	Route::post('get-user', 'UserController@userDetail')->name('admin.getUser');
	Route::get('user/delete/{id}', 'UserController@destroy');
	Route::post('delete-selected-users', 'UserController@deleteSelectedClients')->name('admin.delete-selected-users');

    //Roles
    Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
	Route::post('get-roles', 'RoleController@getRoles')->name('admin.getRoles');
	Route::post('get-role', 'RoleController@roleDetail')->name('admin.getRole');
	Route::get('role/delete/{id}', 'RoleController@destroy');
	Route::post('delete-selected-role', 'RoleController@deleteSelectedRoles')->name('admin.delete-selected-roles');
});
    //Permissions
    Route::resource('permissions','PermissionController');
	Route::post('get-permissions', 'PermissionController@getPermissions')->name('admin.getPermissions');
	Route::post('get-permission', 'PermissionController@permissionDetail')->name('admin.getPermission');
	Route::get('permission/delete/{id}', 'PermissionController@destroy');
	Route::post('delete-selected-permissions', 'PermissionController@deleteSelectedPermission')->name('admin.delete-selected-permissions');
    //Order
    Route::resource('orders','OrderController');
    Route::post('get-orders', 'OrderController@getOrders')->name('admin.getOrders');
    Route::post('get-order', 'OrderController@orderDetail')->name('admin.getOrder');
    Route::get('order/delete/{id}', 'OrderController@destroy');
    Route::post('delete-selected-orders', 'OrderController@deleteSelectedOrders')->name('admin.delete-selected-order');

    //Rates
    //Staff Routes
	Route::resource('rates','RateController');
	Route::post('get-rates', 'RateController@getrates')->name('admin.getrates');
	Route::post('get-rate', 'RateController@rateDetail')->name('admin.getrate');
	Route::get('rate/delete/{id}', 'RateController@destroy');
	Route::post('delete-selected-rates', 'RateController@deleteSelectedrates')->name('admin.delete-selected-rates');

});

