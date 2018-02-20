<?php

/*
version 2.3

Connor / Ali
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Sign-in/login page
Route::get('register', function () {
    return view('register');
});

Route::post('register', 'AuthenticationController@Register');


Route::get('login', function () {
    return view('login');
});

Route::get('logout', function () {
    session()->forget('UID');
    return view('welcome');
});
Route::post('login', 'AuthenticationController@login');

Route::get('home', function () {
    return view('home');
}); //TODO change to ask when implemented

Route::get("addJobPost",function(){
    return view("addJobPost");
});



Route::post("updateJobPostData/","AdminController@updateJobPostData");
Route::get("updateJobPost/{id}","AdminController@updateJobPost");
Route::get("deleteJobPost/{id}","AdminController@deleteJobPost");
Route::post("addJobPost","AdminController@addJobPost");

Route::get("addItem/{type}","ProfileController@add");

Route::get('profile', 'UserProfileController@show');
Route::get('profile/edit/{category}', 'UserProfileController@showEditor');
Route::post('profile/edit', 'UserProfileController@update');
Route::get('admin', 'AdminController@index');
Route::get('admin/suspend/{id}', 'AdminController@suspend');
Route::get('admin/reactivate/{id}', 'AdminController@reactivate');
Route::get('admin/delete/{id}', 'AdminController@deleteUser');
