<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
});

Route::get('/visitor','VisitorController@VisitorIndex');

Route::get('/service','ServicesController@servicesIndex');

Route::get('/getServiceData','ServicesController@getServicesData');

Route::post('/DeleteService','ServicesController@deleteServices'); 

Route::post('/DetailsService','ServicesController@getDetails'); 

Route::post('/UpdateService','ServicesController@updateService'); 

Route::post('/addNewService','ServicesController@addNewService'); 
