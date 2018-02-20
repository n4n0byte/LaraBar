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

Route::get("addJobPost", function () {
    return view("addJobPost");
});


Route::post("updateJobPostData/", "AdminController@updateJobPostData");
Route::get("updateJobPost/{id}", "AdminController@updateJobPost");
Route::get("deleteJobPost/{id}", "AdminController@deleteJobPost");
Route::post("addJobPost", "AdminController@addJobPost");

/* ==== PROFILE ==== */
// --- Views/Forms
Route::get('profile', 'UserProfileController@show');
Route::get('profile/edit/{category}/{id}', 'UserProfileController@showEditor');
Route::get('profile/delete/{category}/{id}', 'UserProfileController@delete');
Route::get('profile/add/{category}', 'UserProfileController@addEditor');
Route::post('profile/editProfile', 'UserProfileController@updateProfile');
Route::post('profile/editEmployment', 'UserProfileController@updateEmployment');
Route::post('profile/editEducation', 'UserProfileController@updateEducation');
Route::post('profile/editSkills', 'UserProfileController@editSkills');
// --- Insert
Route::post('profile/addSkills', 'UserProfileController@createSkills');
Route::post('profile/addEmployment', 'UserProfileController@createEmployment');
Route::post('profile/addEducation', 'UserProfileController@createEducation');

/* ==== ADMIN ==== */
Route::get('admin', 'AdminController@index');
Route::get('admin/suspend/{id}', 'AdminController@suspend');
Route::get('admin/reactivate/{id}', 'AdminController@reactivate');
Route::get('admin/delete/{id}', 'AdminController@deleteUser');
