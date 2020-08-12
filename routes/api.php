<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', 'UserController@show');
    Route::resource('users', 'Admin\UsersController')->middleware('can:only-admin');
    Route::resource('payments', 'Admin\PayementController')->middleware('can:only-admin');
    Route::post('payments', 'Admin\PayementController@store');
    Route::get('/{user}/enrollments', 'EnrollmentController@userEnrollments');
    Route::resource('/enrollments', 'EnrollmentController');
    Route::get('/{user}/courses', 'Teacher\CoursesController@teacherCourses')->middleware('can:teacher-or-admin');
});


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::resource('/categories', 'CategoryController');
Route::resource('/comments', 'CommentController');
Route::get('/courses', 'CourseController@index');
Route::get('/courses/{id}', 'CourseController@show');
Route::resource('/ratings', 'RatingController');
Route::resource('/sub-categories', 'SubCategoryController');
