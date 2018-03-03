<?php

namespace app\Http\Controllers;
use App\Services\Business\AdminGroupsBusinessServiceSingletonDummy as AdminGroupService;

class AdminGroupController {

    private $adminSvc;

    /**
     * AdminGroupController constructor.
     * stores service as member variable
     */
    public function __construct() {
        $this->adminSvc = AdminGroupService::getInstance();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * shows view with list of groups
     */
    public function index(){
        $groups = $this->adminSvc->listAllGroups();
        return view('admin_groups_view')->with(["groups"  => $groups]);
    }

}