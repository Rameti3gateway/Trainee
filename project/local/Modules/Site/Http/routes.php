<?php
use App\Http\Controller\Auth as logincontroller;
Route::group(['middleware' => 'web', 'prefix' => 'site', 'namespace' => 'Modules\Site\Http\Controllers'], function()
{
    // Route::get('/', 'SiteController@index');
    Route::get('/', function () {
        return view('site::trainee-welcome.trainee');
    });
    //  Route::get('/users/{id}', function () {
    //     return view('site::blog.show');
    // });


    // forgotpassword
    Route::get('password/reset','ResetPasswordController@index');
    Route::get('password/reset/{token}','ResetPasswordController@reset');
    //////////////////////    
    

    Route::get('/home','HomeController@index');

    //facebook Auth
    Route::get('login/facebook', 'FacebookAuthController@redirectTofacebook');
    Route::get('login/facebook/callback', 'FacebookAuthController@handlefacebookCallback');

    Route::get('login','LoginController@index');
    Route::get('register','RegisterController@index');
    
    // google Auth
    Route::get('login/google', 'GoogleAuthController@redirectTogoogle');
    Route::get('login/google/callback', 'GoogleAuthController@handlegoogleCallback');

    //show edit update
    Route::prefix('/users')->group(function(){
        Route::get('/{id}','BlogController@show');
        Route::get('/{id}/edit','BlogController@edit');
        Route::post('/{id}','BlogController@update');
        Route::get('/{id}/checkinout','CheckinCheckoutController@index');
        Route::post('/{id}/checkinout/check','CheckinCheckoutController@sep');

        Route::get('/{id}/todolist', 'TodolistController@index');
        Route::post('/{id}/todolist/task','TodolistController@store');
        Route::post('/{id}/todolist/delete/{task}','TodolistController@destroy');
        Route::post('/{id}/todolist/choose','TodolistController@show');
        Route::get('/{id}/todolist/{taskid}/edittodolist/{input}','TodolistController@edittodolist');

        Route::get('/{id}/report','PDFController@index');
        Route::get('/{id}/report/checkincheckout/{type}/{detail}','PDFController@PDFcheckincheckout');
        Route::get('/{id}/report/checkincheckout/{type}/{detail1}/{detail2}','PDFController@PDFcheckincheckoutinterval');

        Route::get('/{id}/report/todolist/{data}','PDFController@PDFtodolist');
        Route::post('/{id}/report/checkincheckout/choose','PDFController@PDFcheckincheckoutChoose');
    
    });
    
    
    //admin
// Route::prefix('/admin')->group(function(){
// 	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
// 	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submitt');
// 	Route::get('/', 'AdminController@index')->name('admin.dashboard');
//     });
});
//test commit

