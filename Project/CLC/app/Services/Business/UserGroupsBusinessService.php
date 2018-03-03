<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 3/3/2018
 * This is my own work.
 */

namespace App\Services\Business;


use App\Model\GroupModel;
use App\Model\UserModel;
use App\Services\BusinessInterfaces\IUserGroupsBusinessService;
use App\Services\Data\UserGroupsDataAccessService;

class UserGroupsBusinessService implements IUserGroupsBusinessService
{
    private static $instance;

    /**
     * @return IUserGroupsBusinessService
     */
    static function getInstance(): IUserGroupsBusinessService
    {
        if (self::$instance == null) {
            self::$instance = new UserGroupsBusinessService();
        }
        return self::$instance;
    }

    /**
     * @param $user
     * @return array
     */
    public function listGroupsForUser($user): array
    {
        // get assoc array from database containing group information
        $raw = UserGroupsDataAccessService::readForUser(true);

        // convert to array of GroupModels
        $groupList = array();
        $i = 0;
        foreach ($raw as $row) {
            $groupList[$i++] = new GroupModel($row["ID"], $row["TITLE"], $row["DESCRIPTION"], $row["SUMMARY"]);
        }

        // return GroupModel array
        return $groupList;
    }

    /**
     * return array of GroupModels
     * @return array
     */
    public function listAllAvailableGroups(): array
    {
        $raw = UserGroupsDataAccessService::readForUser(session("user")->getId());

        // convert to array of GroupModels
        $groupList = array();
        $i = 0;
        foreach ($raw as $row) {
            $groupList[$i++] = new GroupModel($row["ID"], $row["TITLE"],
                $row["DESCRIPTION"], $row["SUMMARY"]);
        }

        // return GroupModel array
        return $groupList;
    }

    /**
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function addUserToGroup($userId, $groupId): bool
    {
        return UserGroupsDataAccessService::create($userId, $groupId);
    }

    /**
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function removeUserFromGroup($userId, $groupId): bool
    {
        return UserGroupsDataAccessService::delete($userId, $groupId);
    }

    /**
     * returns array of UserModels
     * @param $groupId
     * @return array
     */
    public function listUserInGroup($groupId): array
    {
        $raw = UserGroupsDataAccessService::readForGroup($groupId);

        // convert to array of UserModels
        $userList = array();
        $i = 0;
        foreach ($raw as $row) {
            $userList[$i] = new UserModel($row["ID"], $row["USER"],
                $row["PASSWORD"], $row["FIRSTNAME"], $row["LASTNAME"]);
            $userList[$i++]->setAdmin($row["ADMIN"]);
        }

        // return UserModel array
        return $userList;
    }

    /**
     * @return array
     */
    public function listAllGroups(): array
    {
        $raw = UserGroupsDataAccessService::read();

        // convert to array of GroupModels
        $groupList = array();
        $i = 0;
        foreach ($raw as $row) {
            $groupList[$i++] = new GroupModel($row["ID"], $row["TITLE"], $row["DESCRIPTION"], $row["SUMMARY"]);
        }

        // return GroupModel array
        return $groupList;
    }
}