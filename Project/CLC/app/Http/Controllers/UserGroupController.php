<?php

namespace App\Http\Controllers;

use App\Services\Business\AdminGroupsBusinessService;
use App\Services\Business\UserGroupsBusinessService as UserGroupSvc;


class UserGroupController extends Controller
{

    private $userGroupSvc = null;

    function __construct()
    {
        $this->userGroupSvc = UserGroupSvc::getInstance();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Exception
     */
    function index()
    {
        try {
            $groups = $this->userGroupSvc->listAllGroups();
            return view('user_groups', ['groups' => $groups]);
        } catch (ValidationException $ve) {
            throw $ve;
        } catch (Exception $e) {
            return redirect("error");
        }
    }

    /**
     * @param $groupId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Exception
     */
    function viewUsersInGroup($groupId)
    {
        try {
            $users = $this->userGroupSvc->listUsersInGroup($groupId);
            $adminSvc = new AdminGroupsBusinessService();
            $group = $adminSvc->getGroupById($groupId);
            $inGroup = false;
            $curUsr = session('user');

            foreach ($users as $user) {
                if ($user->getId() == $curUsr->getId()) {
                    $inGroup = true;
                    break;
                }
            }

            return view('view_users_in_group', ['users' => $users, 'inGroup' => $inGroup,
                'userId' => $curUsr->getId(),
                'groupId' => $groupId]);
        } catch (ValidationException $ve) {
            throw $ve;
        } catch (\Exception $e) {
            return redirect("error");
        }
    }

    /**
     * @param $userId
     * @param $groupId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function removeUserFromGroup($userId, $groupId)
    {
        try {
            $this->userGroupSvc->removeUserFromGroup($userId, $groupId);
            return redirect()->action('UserGroupController@viewUsersInGroup', $groupId);
        } catch (ValidationException $ve) {
            throw $ve;
        } catch (\Exception $e) {
            return redirect("error");
        }
    }

    /**
     * @param $userId
     * @param $groupId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function addUserToGroup($userId, $groupId)
    {
        try {
            $this->userGroupSvc->addUserToGroup($userId, $groupId);
            return redirect()->action('UserGroupController@viewUsersInGroup', $groupId);
        } catch (ValidationException $ve) {
            throw $ve;
        } catch (\Exception $e) {
            return redirect("error");
        }
    }

}
