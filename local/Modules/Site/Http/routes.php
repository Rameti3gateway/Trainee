<?php
use App\Http\Controller\Auth as logincontroller;
Route::group(['middleware' => 'web', 'prefix' => 'site', 'namespace' => 'Modules\Site\Http\Controllers'], function()
{
    // Route::get('/', 'SiteController@index');
    Route::get('/', function () {
    return view('site::trainee-welcome.Trainee');
    });

    //facebook Auth
    Route::get('login/facebook', 'FacebookAuthController@redirectTofacebook');
    Route::get('login/facebook/callback', 'FacebookAuthController@handlefacebookCallback');

    // google Auth
    Route::get('login/google', 'GoogleAuthController@redirectTogoogle');
    Route::get('login/google/callback', 'GoogleAuthController@handlegoogleCallback');
   
});
