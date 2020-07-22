<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
});

Route::get('/visitor','VisitorController@VisitorIndex');
 
///Service Route 
Route::get('/service','ServicesController@servicesIndex');
Route::get('/getServiceData','ServicesController@getServicesData');
Route::post('/DeleteService','ServicesController@deleteServices'); 
Route::post('/DetailsService','ServicesController@getDetails'); 
Route::post('/UpdateService','ServicesController@updateService'); 
Route::post('/addNewService','ServicesController@addNewService'); 

///Courses Route
Route::get('/courses','CourseController@coursesIndex');
Route::get('/getCourseData','CourseController@getCoursesData');
Route::post('/DeleteCourse','CourseController@deleteCourses'); 
Route::post('/DetailsCourse','CourseController@getDetails'); 
Route::post('/UpdateCourse','CourseController@updateCourses'); 
Route::post('/addNewCourse','CourseController@addNewCourses'); 

///Projects Route
Route::get('/project','ProjectController@projectIndex');
Route::get('/getProjectData','ProjectController@getProjectData');
Route::post('/addNewProject',"ProjectController@addNewProject");
Route::post('/deleteProject','ProjectController@deleteProject');
Route::post('/getEachProject',"ProjectController@getProjectForUpdate");
Route::post('/updateProject','ProjectController@updateProject');
