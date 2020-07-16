<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
});

Route::get('/visitor','VisitorController@VisitorIndex');

Route::get('/service','ServicesController@servicesIndex');

Route::get('/getServiceData','ServicesController@getServicesData');

Route::post('/DeleteService','ServicesController@deleteServices'); 
