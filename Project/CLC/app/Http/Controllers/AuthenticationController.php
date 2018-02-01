<?php
/*
version 1.1

Ali, Connor
CST-256
January 31, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Services\Business\UserBusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Helper\Table;

class AuthenticationController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
         
        $user = new UserModel($inputEmail,$inputPassword);
        $service = new UserBusinessService($user);

        if ($service->login()){
    
            return view("Home",['user' => $user]);
           
        }
        else {
            return view("login_error",['error' => $error = "Login info is incorrect"]);
        }
        
    }
}
