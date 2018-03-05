<?php

namespace App\Http\Controllers;
use App\Services\Business\AdminGroupsBusinessService;
use App\Services\Business\UserGroupsBusinessService as UserGroupSvc;


class UserGroupController extends Controller {

    private $userGroupSvc = null;

    function __construct() {
        $this->userGroupSvc = UserGroupSvc::getInstance();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index(){
        $groups = $this->userGroupSvc->listAllGroups();
        return view('user_groups',['groups' => $groups]);
    }

    /**
     * @param $groupId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function viewUsersInGroup($groupId) {
        $users = $this->userGroupSvc->listUsersInGroup($groupId);
        $adminSvc = new AdminGroupsBusinessService();
        $group = $adminSvc->getGroupById($groupId);
        $inGroup = false;
        $curUsr = session('user');

        foreach ($users as $user){
            if ($user->getId() == $curUsr->getId()){
                $inGroup = true;
                break;
            }
        }

        return view('view_users_in_group',['users' => $users,'inGroup' => $inGroup,
                                                'userId' => $curUsr->getId(),
                                                'groupId' => $groupId]);
    }

    function addUserToGroup($userId,$groupId){
        $this->userGroupSvc->addUserToGroup($userId, $groupId);
        return redirect()->action('UserGroupController@viewUsersInGroup')->with(['groupId' => $groupId]);
    }

}
