<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function ask()
    {
        // if user is logged in, return home
        
        // else, send to login form
        return view('Login');
    }
    
    public function login()
    {
        // create a business service
        
        // get result, store in session
        
        // if successful, go to Home
        return view("Home");
        // if unsuccessful, go to Login
        
    }
}
