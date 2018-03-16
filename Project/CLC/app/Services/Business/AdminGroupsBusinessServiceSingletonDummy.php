<?php
/**
 * version 1.0
 *
 * Student Name: Connor
 * Course Number: CST-256
 * Date: 3/2/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

namespace App\Services\Business;

use App\Model\GroupModel;
use App\Model\UserModel;
use App\Services\BusinessInterfaces\IAdminGroupsBusinessService;

/**
 * Uses session for persistence, works without backend
 * Class AdminGroupsBusinessServiceSingletonDummy
 * @package App\Services\Business
 */
class AdminGroupsBusinessServiceSingletonDummy implements IAdminGroupsBusinessService {

    private static $instance = null;
    private static $instId = 20;
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
     * @param array $details
     * @return bool
     */
    public function createGroup(array $details): bool {
        $groups = session('groups');
        array_push($groups, new GroupModel(self::$instId++,$details["name"],
                                            $details["description"],$details["summary"],
                                            $details["owner"]));
        session(['groups'=>$groups]);
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
        return session('groups');
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

        $groups = session('groups');
        foreach ($groups as $item){
            if ($item->getId() == $id){
                $item->setId($id);
                $item->setName($name);
                $item->setDescription($description);
                $item->setOwner($owner);
                break;
            }
        }

        return true;
    }

    public function getGroupById($id): GroupModel
    {
        // TODO: Implement getGroup() method.
        return new GroupModel();
    }
}