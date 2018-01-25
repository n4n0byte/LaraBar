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
    
    public function login_error(){
        return view('login_error');
    }
    
    public function login(Request $request)
    {
        // create a business service
        
        // get result, store in session
        
        $inputEmail = $request->input('email');
        $inputPassword = $request->input('password');
         
        $email = DB::table('users')->where('email', $inputEmail)->value('EMAIL');
        $pass = DB::table('users')->where('email', $inputPassword)->value('PASSWORD');
        
        if ($email === $inputEmail && $inputPassword === $pass){
    
            return view("Home",['email' => $email]);
           
        }
        else {
            return view("login_error");
        }
        
    }
}
