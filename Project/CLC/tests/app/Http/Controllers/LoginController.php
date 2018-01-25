<?php
/*
version 0.1

Connor
CST-256
January 19, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

class LoginController
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