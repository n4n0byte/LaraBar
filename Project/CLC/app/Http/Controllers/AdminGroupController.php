<?php

namespace app\Http\Controllers;

use App\Services\Business\AdminGroupsBusinessService as AdminGroupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class AdminGroupController
 * @package app\Http\Controllers
 */
class AdminGroupController {

    private $adminSvc;

    /**
     * AdminGroupController constructor.
     * stores service as member variable
     */
    public function __construct() {
        try {
            $this->adminSvc = AdminGroupService::getInstance();
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * shows view with list of groups
     */
    public function index() {
        try {
            $groups = $this->adminSvc->listAllGroups();
            return view('admin_groups_view')->with(["groups" => $groups]);
        } catch (\PDOException $e) {
            return view("error");
        }
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
    public function addGroup(Request $request): RedirectResponse {

        try {
            $this->adminSvc->createGroup($request->input());
            return redirect()->action("AdminGroupController@index");
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param $groupId
     * @return RedirectResponse
     */
    public function removeGroup($groupId) {

        try {
            $this->adminSvc->deleteGroup($groupId);
            return redirect()->action("AdminGroupController@index");
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateGroupDetails(Request $request): RedirectResponse {

        try {
            $this->adminSvc->editGroupDetails($request->input());

            return redirect()->action('AdminGroupController@index');
        } catch (\PDOException $e) {
            return view("error");
        }
    }

    /**
     * @param $id
     * @return $this
     */
    public function showEditGroupView($id) {
        try {
            $group = $this->adminSvc->getGroupById($id);
            return view('edit_group_info')->with(['group' => $group]);
        } catch (\PDOException $e) {
            return view("error");
        }
    }


}