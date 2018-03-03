<?php

namespace App\Services\Business;

use App\Model\GroupModel;
use App\Services\BusinessInterfaces\IAdminGroupsBusinessService;

class AdminGroupsBusinessServiceSingletonDummy implements IAdminGroupsBusinessService {

    private static $instance = null;
    private $groups = array();
    private $users = array();

    /**
     * @return IAdminGroupsBusinessService
     */
    public static function getInstance(): IAdminGroupsBusinessService {

        if (self::$instance == null){
            self::$instance = new AdminGroupsBusinessServiceSingletonDummy();
        }

        return self::$instance;
    }

    /**
     * AdminGroupsBusinessServiceSingletonDummy constructor.
     * initializes instance and provides dummy data
     */
    private function __construct() {
        $userSvc = new UserBusinessService(session()->get('user'));

        // store all users from db
        $users = $userSvc->listUsers();
        $groupName = "group ";

        // creates groups and stores users in each
        for ($i = 0; $i < 10; $i++){
            $group = new GroupModel($groupName . $i, "Lorum Ipsum", "Description",
                "Owner Name",$i);
            array_push($this->groups, $group);
        }
    }


    /**
     * @param array $details
     * @return bool
     */
    public function createGroup(array $details): bool {
        array_push($this->groups, new GroupModel("New Group","None",
                                            "None","None","99"));
        return true;
    }

    /**
     * @param $groupId
     * @return bool
     */
    public function deleteGroup($groupId): bool {
        unset($this->groups,$groupId);
        return true;
    }

    /**
     * @return array
     */
    public function listAllGroups(): array {
        return $this->groups;
    }

    /**
     * @param array $details
     * @return bool
     */
    public function editGroupDetails(array $details): bool {
        $id = $details["id"];
        $name = $details["name"];
        $description = $details["description"];
        $owner = $details["owner"];

        $item = array_search($id, $this->groups);
        $item->setName($name);
        $item->setDescription($description);
        $item->setOwner($owner);
        return true;
    }

}