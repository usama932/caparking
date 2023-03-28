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
    return view('auth.login');
});
Route::get('/user', function () {
    return view('auth.user');
});
Route::get('/clear',function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
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
    

    Route::resource('users', UserController::class);
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/get_plans', 'AdminController@getPlan')->name('admin.plan');
    Route::get('/profile', 'AdminController@edit')->name('admin-profile');
    Route::post('/admin-update', 'AdminController@update')->name('admin-update');
    //Setting Routes
    Route::resource('setting','SettingController');
    //Paypal
    Route::get('handle-payment/{id}', 'PayPalPaymentController@handlePayment')->name('make.payment');
    Route::get('cancel-payment', 'PayPalPaymentController@paymentCancel')->name('cancel.payment');

    Route::post('/payment-success', 'PayPalPaymentController@paymentSuccess')->name('success.payment');


	//User Routes
	Route::resource('clients','ClientController');
	Route::post('get-clients', 'ClientController@getClients')->name('admin.getClients');
	Route::post('get-client', 'ClientController@clientDetail')->name('admin.getClient');
	Route::get('client/delete/{id}', 'ClientController@destroy');
	Route::post('delete-selected-clients', 'ClientController@deleteSelectedClients')->name('admin.delete-selected-clients');

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

     //Plan
    Route::resource('plans','PlanController');
    Route::post('get-plans', 'PlanController@getPlans')->name('admin.getPlans');
    Route::post('get-plan', 'PlanController@planDetail')->name('admin.getPlan');
    Route::get('plan/delete/{id}', 'PlanController@destroy');
    Route::post('delete-selected-plans', 'PlanController@deleteSelectedPlan')->name('admin.delete-selected-plans');

    //Order
    Route::resource('orders','OrderController');
    Route::post('get-orders', 'OrderController@getOrders')->name('admin.getOrders');
    Route::post('get-order', 'OrderController@orderDetail')->name('admin.getOrder');
    Route::get('order/delete/{id}', 'OrderController@destroy');
    Route::post('delete-selected-orders', 'OrderController@deleteSelectedOrders')->name('admin.delete-selected-order');

    //contacts
    Route::resource('contacts','ContactController');
    Route::post('get-contacts', 'ContactController@getContacts')->name('admin.getContacts');
    Route::post('get-contact', 'ContactController@contactDetail')->name('admin.getContact');
    Route::get('contact/delete/{id}', 'ContactController@destroy');
    Route::post('delete-selected-contacts', 'ContactController@deleteSelectedcontract')->name('admin.delete-selected-contact');

    //contacts_types
    Route::resource('contact_types','ContactTypeController');
    Route::post('get-contacttypes', 'ContactTypeController@getContacttype')->name('admin.getContactTypes');
    Route::post('get-contacttype', 'ContactTypeController@contacttypeDetail')->name('admin.getContactType');
    Route::get('contacttype/delete/{id}', 'ContactTypeController@destroy');
    Route::post('delete-selected-contacttype', 'ContactTypeController@deleteSelectedcontacttype')->name('admin.delete-selected-contacttype');
});

