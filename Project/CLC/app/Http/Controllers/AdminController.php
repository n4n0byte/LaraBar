<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Services\Business\SuspendUserBusinessService;
use App\Services\Business\UserBusinessService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index($message)
    {
        // TODO add page for insufficient role-access
        if (!$this->isAdmin())
            return "User does not have administrative privileges";

        // generate users list
        $temp = new UserModel(0);
        $userService = new UserBusinessService($temp);
        $userList = $userService->listUsers();

        // return view with users list
        return view("admin")->with(["userList" => $userList]);
    }

    public function suspend($userId)
    {
        // create suspended_user business service
        $service = new SuspendUserBusinessService();

        // call suspend user method
        $user = new UserModel($userId);
        $service->suspend($user);

        // run index to generate updated user list
        $this->index("User [$userId] suspended.");
    }

    public  function reactivate($userId) {
        // create suspended_user business service
        $service = new SuspendUserBusinessService();

        // call reactive user method
        $user = new UserModel($userId);
        $service->reactivate($user);

        // run index to generate updated user list
        $this->index("User [$userId] suspended.");
    }

    private function isAdmin()
    {
        // TODO check if user has admin access using session
        return TRUE;
    }

}
