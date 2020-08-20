<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', 'Admin\UsersController@show');
    Route::get('/counts', 'Admin\UsersController@counts')->middleware('can:only-admin');
    Route::get('/teachers', 'Admin\UsersController@teachers');
    Route::get('/students', 'Admin\UsersController@students');
    Route::get('/admins', 'Admin\UsersController@admins');
    Route::resource('users', 'Admin\UsersController')->middleware('can:only-admin');
    Route::get('payments/received', 'Admin\PayementController@received')->middleware('can:only-admin');
    Route::get('payments/sent', 'Admin\PayementController@sent')->middleware('can:only-admin');
    Route::resource('payments', 'Admin\PayementController')->middleware('can:only-admin');
    Route::post('payments', 'Admin\PayementController@store');
    Route::get('/user/enrollments', 'EnrollmentController@userEnrollments');
    Route::resource('/enrollments', 'EnrollmentController');
    Route::get('/{user}/courses', 'Teacher\CoursesController@teacherCourses')->middleware('can:teacher-or-admin');
});


Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::resource('/categories', 'CategoryController');
Route::resource('/comments', 'CommentController');
Route::get('/courses', 'CourseController@index');
Route::get('/courses/{id}', 'CourseController@show');
Route::resource('/ratings', 'RatingController');


Route::get('authorize/{provider}', 'AuthController@redirectToProvider');
Route::get('authorize/{provider}/callback', 'AuthController@handleProviderCallback');
