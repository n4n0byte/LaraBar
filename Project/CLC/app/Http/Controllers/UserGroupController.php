<?php

namespace App\Http\Controllers;
use App\Services\Business\UserGroupsBusinessService as UserGroupSvc;

class UserGroupController extends Controller {

    private $userGroupScvc = null;

    function __construct() {
        $this->userGroupScvc = UserGroupSvc::getInstance();
    }

    function index(){
        $groups = $this->userGroupScvc->listAllGroups();
        return view('user_groups',['groups' => $groups]);
    }



}
