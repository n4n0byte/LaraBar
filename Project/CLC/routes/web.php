<?php

/*
version 1.0

Connor
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

Route::post('/register', 'UserController@Register');


Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    return view('welcome');
});
Route::post('/login', 'UserController@login');

Route::get('/home', function () {
    return view('home');
}); //TODO change to ask when implemented


Route::get('/home', 'HomeController@index')->name('home');
