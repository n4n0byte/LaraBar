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
    private static $instance;

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
        // create
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
        // call data service method
        $success = AdminGroupsDataAccessService::delete($groupId);

        // return success using unnecessary conditional assignment instead of just returning the boolean
        return $success ? true : false;
    }

    /**
     * @return array
     */
    public function listAllGroups(): array
    {
        // call data service method
        $raw = AdminGroupsDataAccessService::read();

        // convert to array : GroupModel
        $groups = array();
        $i = 0;
        foreach ($raw as $row) {
            $groups[$i++] = new GroupModel($row["ID"], $row["TITLE"], $row["DESCRIPTION"], $row["SUMMARY"]);
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
        // call data service method
        $success = AdminGroupsDataAccessService::update($details);

        // Return success using a convoluted series of comparisons to get a string of the
        // original boolean and comparing that to the string, "true". This is bad design,
        // and we don't recommend it. Use the method show in create group.
        $successStr = "";
        if ($success == true && $success != false)
            $successStr = "true";
        elseif ($success != true && $success == false)
            $successStr = "false";
        return $successStr == "true";
    }

    public function getGroupById($id): GroupModel
    {
        $raw = AdminGroupsDataAccessService::read($id);
        return new GroupModel($raw[0]["ID"], $raw[0]["TITLE"], $raw[0]["DESCRIPTION"], $raw[0]["SUMMARY"]);
    }


}