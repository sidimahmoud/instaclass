<?php

use Illuminate\Support\Facades\Route;

Route::get('email/verify/{id}', 'VerificationController@verify');
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::resource('/categories', 'CategoryController');
Route::get('/subcats/{id}', 'SubCategoryController@subCategories');
Route::resource('/sub-categories', 'SubCategoryController');
Route::get('/courses', 'CourseController@index');
Route::get('/all-courses', 'CourseController@filter');
Route::get('/courses/{id}', 'CourseController@show');
Route::get('/sections/{id}', 'CourseFileController@show');
Route::get('/courses/search/{q}', 'CourseController@search');
Route::post('/courses/demander', 'DemandsController@store');
Route::post('/contacter', 'ContactsController@store');
Route::get('/class/{id}', 'CourseController@categoryCourses');
Route::post('/newsletter', 'NewsletterController@store');
Route::put('/sections/{id}', 'CourseFileController@updateLinks');
Route::get('authorize/{provider}', 'AuthController@redirectToProvider');
Route::get('authorize/{provider}/callback', 'AuthController@handleProviderCallback');
Route::get('/troncate-all-enrollments', 'EnrollmentController@deleteAllEnrollement');
// Send reset password mail
Route::post('reset-password', 'AuthController@sendPasswordResetLink');
// handle reset password form process
Route::post('reset/password', 'AuthController@resetPassword');

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('can:only-admin')->group(function () {
        Route::get('/students', 'Admin\UsersController@students');
        Route::get('/admins', 'Admin\UsersController@admins');
        Route::get('/teachers', 'Admin\UsersController@teachers');
        Route::get('/banned', 'Admin\UsersController@banned');
        Route::get('/banish/{id}', 'Admin\UsersController@banish');
        Route::get('/unblock/{id}', 'Admin\UsersController@unblock');
        Route::get('/counts', 'Admin\UsersController@counts');
        Route::get('/payments/received', 'Admin\PayementController@received');
        Route::get('/payments/sent', 'Admin\PayementController@sent');
        Route::resource('payments', 'Admin\PayementController');
        Route::get('/demands', 'DemandsController@index');
        Route::get('/contacts', 'ContactsController@index');
        Route::get('/statistics', 'Teacher\CoursesController@statistics');
        Route::resource('/newsletter', 'NewsletterController');

    });

    Route::middleware('can:teacher-or-admin')->group(function () {
        Route::get('/teacher/{id}/courses', 'Admin\UsersController@teacherCourses');
        Route::get('/user/courses', 'Teacher\CoursesController@teacherCourses');
        Route::get('/teacher/details', 'Admin\UsersController@teacherDetails');
        Route::get('/teacher/payments', 'Admin\UsersController@teacherPayments');
        Route::resource('/course', 'Teacher\CoursesController');
        Route::post('/course/sections', 'CourseFileController@store');
        Route::get('/upcoming-section', 'CourseFileController@upcomingSection');
        //Live courses
        Route::post('/create-room/{myRoom}/{user}/{recorded}', 'LiveCoursesController@createRoom');
        Route::post('/endroom/{myRoom}', 'LiveCoursesController@closeRoom');
        Route::get('/room/{roomSid}/participants', 'LiveCoursesController@roomParticipants');
        Route::get('/rooms/{uniqueName}', 'LiveCoursesController@myRooms');
        Route::post('/remove-participant/{roomSid}/{user}', 'LiveCoursesController@removeParticipant');
        Route::post('/add-speciment', 'Admin\UsersController@addSpeciment');
    });
    Route::get('/room-recordings/{roomSid}', 'LiveCoursesController@roomRecordings');
    Route::get('/access_token/{muRoom}/{user}', 'LiveCoursesController@generate_token');
    Route::get('/rooms-by-status/{status}', 'LiveCoursesController@retrieveRoomsbyStatus');
    Route::get('/room-details/{myRoom}', 'LiveCoursesController@roomDetails');

    Route::get('/me', 'Admin\UsersController@show');
    Route::resource('/user', 'Admin\UsersController');
    Route::get('/enrollments', 'EnrollmentController@userEnrollments');
    Route::get('/upcoming-classes', 'EnrollmentController@upcomingClasses');
    Route::get('/enrolled-students/{id}', 'EnrollmentController@courseEnrollments');
    Route::post('/enroll', 'EnrollmentController@store');
    Route::post('/enroll-in-course', 'EnrollmentController@EnrollInAllSections');
    Route::post('/pay', 'Admin\PayementController@paymentProcess');
    Route::get('/my-receipts', 'Admin\PayementController@studentPayments');
    Route::post('/rate', 'RatingController@store');
});
