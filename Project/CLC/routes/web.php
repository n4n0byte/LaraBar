<?php

/*
version 1.1

Connor / Ali
CST-256
January 24, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Sign-in/login page
Route::get('/register', function () {
    return view('register');
});

Route::post('/register', 'AuthenticationController@Register');


Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    session()->forget('UID');
    return view('welcome');
});
Route::post('/login', 'AuthenticationController@login');

Route::get('/home', function () {
    return view('Home');
}); //TODO change to ask when implemented


Route::get('/profile',function(){
    return view('profile');
});