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
use App\Services\Utility\LarabarLogger;

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
     * used: 1
     * Add a user to a group in the database
     * @param $userId
     * @param $groupId
     * @return bool
     * @throws \Exception
     */
    public function addUserToGroup($userId, $groupId): bool
    {
        LarabarLogger::info("-> UserGroupsBusinessService::removeUserFromGroup");

        // Call database create method. Return true if creation successful.
        return UserGroupsDataAccessService::create($userId, $groupId);
    }

    /**
     * used: 1
     * Remove a user from a group in the database
     * @param $userId
     * @param $groupId
     * @return bool
     * @throws \Exception
     */
    public function removeUserFromGroup($userId, $groupId): bool
    {
        LarabarLogger::info("-> UserGroupsBusinessService::removeUserFromGroup");

        // Call data service to remove user. Return true if successful.
        return UserGroupsDataAccessService::delete($userId, $groupId);
    }

    /**
     * used: 1
     * returns array of UserModels
     * @param $groupId
     * @return array
     * @throws \Exception
     */
    public function listUsersInGroup($groupId): array
    {
        LarabarLogger::info("-> UserGroupsBusinessService::listUsersInGroup");

        // get users in group from database
        $raw = UserGroupsDataAccessService::readForGroup($groupId);

        // convert to array of UserModels
        $userList = array();
        $i = 0;
        foreach ($raw as $row) {
            $userList[$i] = new UserModel($row["ID"], $row["EMAIL"],
                $row["PASSWORD"], $row["FIRSTNAME"], $row["LASTNAME"]);
            $userList[$i++]->setAdmin($row["ADMIN"]);
        }

        // return UserModel array
        return $userList;
    }

    /**
     * used: 1
     * Get all groups from database
     * @return array
     * @throws \Exception
     */
    public function listAllGroups(): array
    {
        LarabarLogger::info("-> UserGroupsBusinessService::listAllGroups");

        // get group data from database
        $raw = UserGroupsDataAccessService::read();

        // convert data to array of GroupModels
        $groupList = array();
        foreach ($raw as $row)
            array_push($groupList, new GroupModel($row["ID"], $row["TITLE"], $row["DESCRIPTION"], $row["SUMMARY"]));

        // return GroupModel array
        return $groupList;
    }
}