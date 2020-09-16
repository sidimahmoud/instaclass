<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

//
//Route::get('/', function () {
//    return view('welcome');
//})->name('welcome');


Route::get('/{any}', 'HomeController@index')->where('any', '.*');

Route::resource('categories', 'CategoryController');