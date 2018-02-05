<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Services\Business\UserBusinessService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index() {
        // TODO check if user has admin access using session

        // generate users list
        $temp = new UserModel(0);
        $service = new UserBusinessService($temp);
        $userList = $service->listUsers();
        // return view with users list
        return view("admin")->with(["userList" => $userList]);
    }

    public function suspend($userId) {

    }

}
