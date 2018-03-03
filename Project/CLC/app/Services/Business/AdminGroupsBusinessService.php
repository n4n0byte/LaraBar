<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 3/2/2018
 * This is my own work.
 */

namespace App\Services\Business;


use App\Model\GroupModel;
use App\Services\BusinessInterfaces\IAdminGroupsBusinessService;
use App\Services\Data\AdminGroupsDataAccessService;

class AdminGroupsBusinessService implements IAdminGroupsBusinessService
{
    private static $instance = null;

    /**
     * @return IAdminGroupsBusinessService
     */
    public static function getInstance(): IAdminGroupsBusinessService
    {
        if (self::$instance == null) {
            self::$instance = new AdminGroupsBusinessService();
        }

        return self::$instance;
    }

    /**
     * @param array $details
     * @return bool
     */
    public function createGroup(array $details): bool
    {
        $success = AdminGroupsDataAccessService::create($details);

        // return success
        return $success;
    }

    /**
     * @param $groupId
     * @return bool
     */
    public function deleteGroup($groupId): bool
    {
        // TODO: Implement deleteGroup() method.
        // call data service method
        $success = false;

        // return success
        return $success;
    }

    /**
     * @return array
     */
    public function listAllGroups(): array
    {
        // TODO: Implement listAllGroups() method.
        // call data service method
        $raw = array();

        // convert to array : GroupModel
        $groups = array();
        $i = 0;
        foreach($raw as $row) {
            $groups[$i] = new GroupModel($row["ID"],$row["TITLE"], $row["DESCRIPTION"], $row["SUMMARY"]);
        }

        // return array of GroupModel
        return $groups;
    }

    /**
     * @param array $details
     * @return bool
     */
    public function editGroupDetails(array $details): bool
    {
        // TODO: Implement editGroupDetails() method.
        // call data service method
        $success = false;

        // return success
        return $success;
    }
}