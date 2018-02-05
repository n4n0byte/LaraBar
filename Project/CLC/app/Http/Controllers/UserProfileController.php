<?php
/*
version 1.0

Ali
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
use \App\Services\Data\UserProfileDataAccessService;

class UserProfileController extends Controller {

    function show(){
        $profile = new UserProfileDataAccessService();
        return view('profile')->with(['data' => $profile->read()]);
    }

}