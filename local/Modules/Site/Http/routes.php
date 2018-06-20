<?php

Route::group(['middleware' => 'web', 'prefix' => 'site', 'namespace' => 'Modules\Site\Http\Controllers'], function()
{
    // Route::get('/', 'SiteController@index');
    Route::get('/', function () {
    return view('site::trainee-welcome.Trainee');
});
});
