<?php

namespace app\Services\Business;

use App\Model\GroupModel;
use App\Model\UserModel;
use App\Services\BusinessInterfaces\IUserGroupsBusinessService;

class UserGroupsBusinessServiceServiceSingletonDummy implements IUserGroupsBusinessService {

    private static $instance = null;

    private function __construct() {

        $userSvc = new UserBusinessService(new UserModel(0));

        if(session('groups') == null){
            // store all users from db
            $users = $userSvc->listUsers();
            $groupName = "group ";

            // creates groups and stores users in each
            for ($i = 0; $i < 10; $i++){
                $group = new GroupModel($groupName . $i, "Lorum Ipsum", "Description",
                    "Owner Name",$i);
                array_push($this->groups, $group);
            }

            session(['groups' => $this->groups]);
            session()->save();
        }


    }

    /**
     * @return IUserGroupsBusinessService
     */
    static function getInstance(): IUserGroupsBusinessService {

        if (self::$instance == null){
            self::$instance = new UserGroupsBusinessServiceServiceSingletonDummy();
        }

        return self::$instance;

    }

    /**
     * @param $user
     * @return array
     */
    public function listGroupsForUser($user): array {

    }

    public function addUserToGroup($userId, $groupId): bool {
        // TODO: Implement addUserToGroup() method.
    }

    public function removeUserFromGroup($userId, $groupId): bool {
        // TODO: Implement removeUserFromGroup() method.
    }

    public function listAllAvailableGroups(): array {
        // TODO: Implement listAllAvailableGroups() method.
    }

    public function listUsersInGroup($groupId): array {
        // TODO: Implement listUserInGroup() method.
    }

    public function listAllGroups(): array {
        // TODO: Implement listAllGroups() method.
    }

}