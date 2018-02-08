<?php
/*
version 2.1

Ali, Connor
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Services\Business\SuspendUserBusinessService;
use App\Services\Business\UserBusinessService;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{

    public function ask()
    {
        // if user is logged in, return home

        // else, send to login form
        return view('Login');
    }

    public function login_error()
    {
        return view('login_error');
    }

    /**
     * registers user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register(Request $request)
    {
        // get inputs
        $inputEmail = $request->input('email');
        $inputPassword = $request->input('password');
        $inputFirstName = $request->input('firstName');
        $inputLastName = $request->input('lastName');

        // create UserModel
        if ($inputPassword == "" || $inputEmail == "")
            return view("register")->with(['user' => -1]);
        $user = new UserModel(0, $inputEmail, $inputPassword, $inputFirstName, $inputLastName);

        // create a business service
        $service = new UserBusinessService($user);
        // attempt registration
        if ($user = $service->register()) {
            session()->put(['UID' => $user->getId()]);
            session()->save();
            return view("welcome");
        } else {
            return view("register")->with(['user' => $user]);
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
        // get inputs
        $inputEmail = $request->input('email');
        $inputPassword = $request->input('password');

        // create UserModel
        if ($inputPassword == "" || $inputEmail == "")
            return view("login")->with(['status' => 1]);
        $user = new UserModel(0, $inputEmail, $inputPassword);

        // create a business service
        $service = new UserBusinessService($user);

        // attempt login
        if ($status = $service->login()) {
            $susService = new SuspendUserBusinessService();
            session()->put(['UID' => $user->getId()]);
            session()->save();
            return $susService->suspensionStatus($user) ? view("suspend") : view("home")->with(['user' => $user]);
        } else {
            return view("login")->with(['user' => $user, 'status' => $status]);
        }

    }
}
