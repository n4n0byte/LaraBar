<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 3/4/2018
 * This is my own work.
 */

namespace App\Services\Business;

use App\Model\GroupModel;
use App\Services\BusinessInterfaces\IAdminGroupsBusinessService;
use App\Services\Data\AdminGroupsDataAccessService;
use App\Services\Utility\LarabarLogger;

/**
 * Business Service for processing data
 * then using Data Service CRUD operations
 * Class AdminGroupsBusinessService
 * @package App\Services\Business
 */
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
     * used: 1
     * Add a new group to the database
     * @param array $details
     * @return bool
     * @throws \Exception
     */
    public function createGroup(array $details): bool
    {
        LarabarLogger::info("-> AdminGroupsBusinessService::createGroup", $details);

        // create
        $success = AdminGroupsDataAccessService::create($details);

        // return true if create successful
        return $success;
    }

    /**
     * @param $groupId
     * @return bool
     * @throws \Exception
     */
    public function deleteGroup($groupId): bool
    {
        // call data service method
        $success = AdminGroupsDataAccessService::delete($groupId);

        // return success using unnecessary conditional assignment instead of just returning the boolean
        return $success ? true : false;
    }

    /**
     * used: 1
     * Get all groups from database
     * @return array
     * @throws \Exception
     */
    public function listAllGroups(): array
    {
        // call data service method to get groups
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
     * used: 1
     * Update group information in database
     * @param array $details
     * @return bool
     * @throws \Exception
     */
    public function editGroupDetails(array $details): bool
    {
        // call data service method and pass updated details. Return true if update successful.
        return AdminGroupsDataAccessService::update($details);
    }

    /**
     * used: 2
     * retrieves a group from the database
     * @param $id
     * @return GroupModel
     * @throws \Exception
     */
    public function getGroupById($id): GroupModel
    {
        LarabarLogger::info("-> AdminGroupsBusinessService::getGroupById", $id);

        // call data access service method and pass group id
        $raw = AdminGroupsDataAccessService::read($id);

        // return group model
        return new GroupModel($raw[0]["ID"], $raw[0]["TITLE"], $raw[0]["DESCRIPTION"], $raw[0]["SUMMARY"]);
    }


}