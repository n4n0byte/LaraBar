<?php
/*
version 0.1

Ali
CST-256
January 19, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Helper\Table;

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
    
    /**
     * registers user
     */
    public function register(Request $request){
        
        $inputEmail = $request->input('email');
        $inputPassword = $request->input('password');
        $inputFirstName = $request->input('firstName');
        $inputLastName = $request->input('lastName');
        
        
        $email = DB::table('users')->where('email', $inputEmail)->value('EMAIL');
        
        
        if ($email == ""){
            // inserts data if email is not found
            DB::table('users')->insert(
                ['email' => $inputEmail, 'password' => $inputPassword, 'firstname' => $inputFirstName, 'lastName' => $inputLastName]
            );
            
            return view("Home",['email' => $email]);
            
        }
        else {
            return view("login_error",['error' => $error = "Someone else has that Email already"]);
        }
        
    }
    
    /**
     * checks for valid inputs,
     * shows error page if input is invalid
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function login(Request $request)
    {
        // create a business service
        
        // get result, store in session
        
        $inputEmail = $request->input('email');
        $inputPassword = $request->input('password');
         
        $email = DB::table('users')->where('email', $inputEmail)->value('EMAIL');
        $pass = DB::table('users')->where('password', $inputPassword)->value('PASSWORD');
        
        if ($email === $inputEmail && $inputPassword === $pass){
    
            return view("Home",['email' => $email]);
           
        }
        else {
            return view("login_error",['error' => $error = "Login info is incorrect"]);
        }
        
    }
}
