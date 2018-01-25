<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function ask()
    {
        // if user is logged in, return home
        
        // else, send to login form
        return view('Login');
    }
    
    public function login(Request $request)
    {
        // create a business service
        
        // get result, store in session
        
        $email = $request->input('email');
        $password = $request->input('password');
         
        $results = DB::select('select * from users where email = :email and password = :password', ['email' => $email, 'password' => $password ]);
        
        if (sizeof($results) == 1){
            echo "goof";
        }
        else{
            echo "bad";
        }
        
        // if successful, go to Home
        return view("Home",['results' => $results]);
        // if unsuccessful, go to Login
        
    }
}
