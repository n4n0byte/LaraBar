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
    session()->forget(['UID', 'user']);
    return view('welcome');
});
Route::post('login', 'AuthenticationController@login');

Route::get('home', function () {
    return view('home');
})->middleware('auth'); //TODO change to ask when implemented

Route::get("addJobPost", function () {
    return view("addJobPost");
});

Route::post("updateJobPostData/", "AdminController@updateJobPostData");
Route::get("updateJobPost/{id}", "AdminController@updateJobPost");
Route::get("deleteJobPost/{id}", "AdminController@deleteJobPost");
Route::post("addJobPost", "AdminController@addJobPost");

/* ==== PROFILE ==== */
// --- Views/Forms
Route::get('profile', 'UserProfileController@show')->middleware('auth');
Route::get('profile/edit/{category}/{id}', 'UserProfileController@showEditor')->middleware('auth');
Route::get('profile/delete/{category}/{id}', 'UserProfileController@delete')->middleware('auth');
Route::get('profile/add/{category}', 'UserProfileController@addEditor')->middleware('auth');
Route::post('profile/editProfile', 'UserProfileController@updateProfile')->middleware('auth');
Route::post('profile/editPersonalInfo', 'UserProfileController@updatePersonalInfo')->middleware('auth');
Route::post('profile/editEmployment', 'UserProfileController@updateEmployment')->middleware('auth');
Route::post('profile/editEducation', 'UserProfileController@updateEducation')->middleware('auth');
Route::post('profile/editSkills', 'UserProfileController@updateSkills')->middleware('auth');
Route::post('profile/editLocation', 'UserProfileController@updateLocation')->middleware('auth');
Route::post('profile/editBiography', 'UserProfileController@updateBiography')->middleware('auth');

// --- Insert
Route::post('profile/addSkills', 'UserProfileController@createSkills')->middleware('auth');
Route::post('profile/addEmployment', 'UserProfileController@createEmployment')->middleware('auth');
Route::post('profile/addEducation', 'UserProfileController@createEducation')->middleware('auth');

/* ==== ADMIN ==== */
Route::get('admin', 'AdminController@index')->middleware('auth', 'admin');
Route::get('admin/suspend/{id}', 'AdminController@suspend')->middleware('auth', 'admin');
Route::get('admin/reactivate/{id}', 'AdminController@reactivate')->middleware('auth', 'admin');
Route::get('admin/delete/{id}', 'AdminController@deleteUser')->middleware('auth', 'admin');

/* ==== Admin Profile Management ==== */

// main admin view
Route::get('manageGroups', 'AdminGroupController@index')->middleware('auth', 'admin');

// add groups
Route::get('addGroup', 'AdminGroupController@showAddGroupView')->middleware('auth', 'admin');
Route::post('addGroup', 'AdminGroupController@addGroup')->middleware('auth', 'admin');

// edit groups
Route::get('editGroup/{id}', 'AdminGroupController@showEditGroupView')->middleware('auth', 'admin');
Route::post('editGroup', 'AdminGroupController@updateGroupDetails')->middleware('auth', 'admin');

// delete groups
Route::get('removeGroup/{id}','AdminGroupController@removeGroup');

/* ==== User Group Management ==== */

// shows user group ui
Route::get('userGroups', "UserGroupController@index")->middleware('auth');

// add user to group
Route::get('addUserToGroup/{userId}/{groupId}', 'UserGroupController@addUserToGroup')->middleware('auth', 'group');

// remove user from group
Route::get('removeUserFromGroup/{userId}/{groupId}', 'UserGroupController@removeUserFromGroup')->middleware('auth', 'group');

// show users in group
Route::get('viewUsersInGroup/{groupId}', 'UserGroupController@viewUsersInGroup')->middleware('auth', 'group');

/* ==== Job Search ==== */
// search for jobs
Route::post('search', 'JobSearchController@search');//->middleware('auth');

// view job description
Route::get('view_job/{id}', 'JobSearchController@show');//->middleware('auth');

/* ==== Profile REST ==== */
Route::resource("/api/profile","ProfileRestController");

/* ==== Job REST ==== */
Route::resource("/api/jobs","JobRestController");
Route::get("/api/jobs/byname/{id}","JobRestController@searchByName");

