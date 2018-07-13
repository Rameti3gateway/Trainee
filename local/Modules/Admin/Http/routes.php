<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    //Route::get('/', 'AdminController@index');

    Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'AdminLoginController@login')->name('admin.login.submitt');
	Route::get('/', 'AdminController@index')->name('admin');

	//forgot password
	

	Route::get('/{id}/dashboard', 'AdminController@dashboard');
	Route::get('/{id}/member', 'AdminController@member')->name('admin-member');
	Route::get('/{id}/member/{userid}/editadmin','AdminController@editadmin');
	Route::post('/{id}/member/{userid}/editprocess','AdminController@editprocess');
	Route::get('/{id}/member/createnewadmin','AdminController@createnewadmin');
	Route::post('/{id}/member/createnewadminprocess','AdminController@createnewadminprocess');
	Route::post('/{id}/member/{userid}/deleteadmin','AdminController@deleteadmin');
	
	
	
	Route::get('/{id}/showprofile/{userid}','AdminController@showprofile');
	Route::post('/{id}/showprofile/{userid}/showtodolist','AdminController@showtodolist');
	Route::post('/{id}/showprofile/{userid}/selectweekormonth','AdminController@selectweekormonth');

	

	Route::get('/{id}/showprofile/{userid}/showgraph/{date}','AdminController@showgraph');
	

});
