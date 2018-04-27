<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Services\Business\AdminGroupsBusinessService;
use App\Services\Business\UserGroupsBusinessService as UserGroupSvc;
use App\Services\Utility\ILogger;


class UserGroupController extends Controller
{

    private $userGroupSvc = null;
    private $logger;

    function __construct(ILogger $logger)
    {
        $this->userGroupSvc = UserGroupSvc::getInstance();
        $this->logger = $logger;
    }

    /**
     * Render groups page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Exception
     */
    function index()
    {
        $this->logger->info("UserGroupController::index");
        try {

            // get all groups from business service method
            $groups = $this->userGroupSvc->listAllGroups();

            // return view with groups
            return view('user_groups', ['groups' => $groups]);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserGroupController validation exception");
            throw $ve;
        } catch (Exception $e) {
            $this->logger->error("UserGroupController::index error: " . $e);
            return redirect("error");
        }
    }

    /**
     * Return a view for a group with all users in group
     * @param $groupId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Exception
     */
    function viewUsersInGroup($groupId)
    {
        $this->logger->info("-> UserGroupController::viewUsersInGroup");
        try {

            // call business service to select all users in a group
            $users = $this->userGroupSvc->listUsersInGroup($groupId);

            // get group by id from database
            $adminSvc = new AdminGroupsBusinessService();
            $group = $adminSvc->getGroupById($groupId);

            // iterate through group members to see if user is inGroup
            $inGroup = false;
            $curUsr = session('user');
            /* @var $user UserModel */
            foreach ($users as $user) {
                if ($user->getId() == $curUsr->getId()) {
                    $inGroup = true;
                    break;
                }
            }

            // return view with group and users
            return view('view_users_in_group', ['users' => $users, 'inGroup' => $inGroup,
                'userId' => $curUsr->getId(),
                'groupId' => $groupId]);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserGroupController validation exception");
            throw $ve;
        } catch (\Exception $e) {
            $this->logger->error("UserGroupController::index error: " . $e);
            return redirect("error");
        }
    }

    /**
     * Remove a user from a group
     * @param $userId
     * @param $groupId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function removeUserFromGroup($userId, $groupId)
    {
        $this->logger->info("-> UserGroupController::removeUserFromGroup");
        try {

            // call business service remove method and pass IDs for user and group
            $this->userGroupSvc->removeUserFromGroup($userId, $groupId);

            // return a redirect to the viewUsersInGroup action
            return redirect()->action('UserGroupController@viewUsersInGroup', $groupId);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserGroupController validation exception");
            throw $ve;
        } catch (\Exception $e) {
            $this->logger->error("UserGroupController::index error: " . $e);
            return redirect("error");
        }
    }

    /**
     * Add a user to a group
     * @param $userId
     * @param $groupId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    function addUserToGroup($userId, $groupId)
    {
        $this->logger->info("-> UserGroupController::addUserToGroup");
        try {

            // call business service to add user to group
            $this->userGroupSvc->addUserToGroup($userId, $groupId);

            // redirect to viewUsersInGroup action
            return redirect()->action('UserGroupController@viewUsersInGroup', $groupId);
        } catch (ValidationException $ve) {
            $this->logger->warning("UserGroupController validation exception");
            throw $ve;
        } catch (\Exception $e) {
            $this->logger->error("UserGroupController::index error: " . $e);
            return redirect("error");
        }
    }

}
