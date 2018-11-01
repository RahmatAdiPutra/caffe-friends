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
// Route::get('/home', function () {
// 	return view('home');
// });

// Route::get('/', 'HomeController@index')->name('home');

// Auth::routes();

Route::resource('role', 'RoleController');
Route::resource('permission', 'PermissionController');

// Route::resource('position', 'PositionController');

Route::get('/position', 'PositionController@index');
Route::get('/position/create', 'PositionController@create');
Route::get('/position/{position}', 'PositionController@show');
Route::post('/position', 'PositionController@store');
Route::get('/position/{position}/edit', 'PositionController@edit');
Route::patch('/position/{position}', 'PositionController@update');
Route::delete('/position/{position}', 'PositionController@destroy');

// Route::resource('employee', 'EmployeeController');

Route::get('/', 'EmployeeController@base');
Route::get('/base', 'EmployeeController@base');
Route::get('/employee-home', 'EmployeeController@home');
Route::get('/employee', 'EmployeeController@index');
Route::get('/employee/create', 'EmployeeController@create');
Route::get('/employee/{employee}', 'EmployeeController@show');
Route::post('/employee', 'EmployeeController@store');
Route::get('/employee/{employee}/edit', 'EmployeeController@edit');
Route::patch('/employee/{employee}', 'EmployeeController@update');
Route::delete('/employee/{employee}', 'EmployeeController@destroy');
Route::get('/employee/picDetailItem/{employee}', 'EmployeeController@showDetailItem');

Route::get('employee-login', 'Employee\LoginController@showLoginForm')->name('employee.login');
Route::post('employee-login', 'Employee\LoginController@login');
Route::post('employee-logout', 'Employee\LoginController@logout')->name('employee.logout');

Route::get('employee-register', 'Employee\RegisterController@showRegistrationForm')->name('employee.register');
Route::post('employee-register', 'Employee\RegisterController@register');
Route::get('employee-verify', 'Employee\RegisterController@verify')->name('employee.verify');
Route::get('employee-verify/{email}/{remember_token}', 'Employee\RegisterController@sendEmailDone')->name('employee.send');

Route::get('employee-password/reset', 'Employee\ForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
Route::post('employee-password/email', 'Employee\ForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
Route::get('employee-password/reset/{token}', 'Employee\ResetPasswordController@showResetForm')->name('employee.password.reset');
Route::post('employee-password/reset', 'Employee\ResetPasswordController@reset')->name('employee.password.update');

// Route::resource('member', 'MemberController');

Route::get('/member', 'MemberController@index');
Route::get('/member/create', 'MemberController@create');
Route::get('/member/{member}', 'MemberController@show');
Route::post('/member', 'MemberController@store');
Route::get('/member/{member}/edit', 'MemberController@edit');
Route::patch('/member/{member}', 'MemberController@update');
Route::delete('/member/{member}', 'MemberController@destroy');

// Route::resource('item', 'ItemController');

Route::get('/item', 'ItemController@index');
Route::get('/item/create', 'ItemController@create');
Route::get('/item/{item}', 'ItemController@show');
Route::post('/item', 'ItemController@store');
Route::get('/item/{item}/edit', 'ItemController@edit');
Route::patch('/item/{item}', 'ItemController@update');
Route::delete('/item/{item}', 'ItemController@destroy');

// Route::resource('detailItem', 'DetailItemController');

Route::get('/detailItem', 'DetailItemController@index');
Route::get('/detailItem/create', 'DetailItemController@create');
Route::get('/detailItem/{detailItem}', 'DetailItemController@show');
Route::post('/detailItem', 'DetailItemController@store');
Route::get('/detailItem/{detailItem}/edit', 'DetailItemController@edit');
Route::patch('/detailItem/{detailItem}', 'DetailItemController@update');
Route::delete('/detailItem/{detailItem}', 'DetailItemController@destroy');

// Route::resource('order', 'OrderController');

Route::get('/order', 'OrderController@index');
Route::get('/order/create', 'OrderController@create');
Route::get('/order/{order}', 'OrderController@show');
Route::post('/order', 'OrderController@store');
Route::get('/order/{order}/edit', 'OrderController@edit');
Route::patch('/order/{order}', 'OrderController@update');
Route::delete('/order/{order}', 'OrderController@destroy');

// Route::resource('detailOrder', 'DetailOrderController');

Route::get('/detailOrder', 'DetailOrderController@index');
Route::get('/detailOrder/create', 'DetailOrderController@create');
Route::get('/detailOrder/{detailOrder}', 'DetailOrderController@show');
Route::post('/detailOrder', 'DetailOrderController@store');
Route::get('/detailOrder/{detailOrder}/edit', 'DetailOrderController@edit');
Route::patch('/detailOrder/{detailOrder}', 'DetailOrderController@update');
Route::delete('/detailOrder/{detailOrder}', 'DetailOrderController@destroy');

// Route::resource('approvOrder', 'ApprovOrderController');

Route::get('/approvOrder', 'ApprovOrderController@index');
Route::get('/approvOrder/create', 'ApprovOrderController@create');
Route::get('/approvOrder/{approvOrder}', 'ApprovOrderController@show');
Route::post('/approvOrder', 'ApprovOrderController@store');
Route::get('/approvOrder/{approvOrder}/edit', 'ApprovOrderController@edit');
Route::patch('/approvOrder/{approvOrder}', 'ApprovOrderController@update');
Route::delete('/approvOrder/{approvOrder}', 'ApprovOrderController@destroy');

// Route::resource('payout', 'PayoutController');

Route::get('/payout', 'PayoutController@index');
Route::get('/payout/create', 'PayoutController@create');
Route::get('/payout/{payout}', 'PayoutController@show');
Route::post('/payout', 'PayoutController@store');
Route::get('/payout/{payout}/edit', 'PayoutController@edit');
Route::patch('/payout/{payout}', 'PayoutController@update');
Route::delete('/payout/{payout}', 'PayoutController@destroy');