<?php

namespace app\Http\Controllers;
use App\Services\Business\AdminGroupsBusinessService as AdminGroupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
    public function index() {
        $groups = $this->adminSvc->listAllGroups();
        return view('admin_groups_view')->with(["groups"  => $groups]);
    }

    /**
     * shows view that adds a group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddGroupView() {
        return view('add_group');
    }

    /**
     * Request variables passed in should be
     * groupName, groupDescription, groupSummary
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addGroup(Request $request) : RedirectResponse {

        $this->adminSvc->createGroup($request->input());
        return redirect()->action("AdminGroupController@index");

    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateGroupDetails(Request $request) : RedirectResponse {

        $this->adminSvc->editGroupDetails($request->input());

        return redirect()->action('AdminGroupController@index');

    }

    /**
     * @param $id
     * @return $this
     */
    public function showEditGroupView($id) {

        $groups = $this->adminSvc->listAllGroups();
        $curGroup = null;

        foreach ($groups as $group){
            if ($group->getId() == $id){
                $curGroup = $group;
            }
        }

        return view('edit_group_info')->with(['group' => $curGroup]);
    }


}