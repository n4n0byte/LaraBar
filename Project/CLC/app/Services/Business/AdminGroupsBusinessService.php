<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 3/2/2018
 * This is my own work.
 */

namespace App\Services\Business;


use App\Services\BusinessInterfaces\IAdminGroupsBusinessService;

class AdminGroupsBusinessService implements IAdminGroupsBusinessService
{

    /**
     * @return IAdminGroupsBusinessService
     */
    public static function getInstance(): IAdminGroupsBusinessService
    {
        // TODO: Implement getInstance() method.
    }

    /**
     * @param array $details
     * @return bool
     */
    public function createGroup(array $details): bool
    {
        // make sure object has been instantiated
        // TODO: Implement createGroup() method.
    }

    /**
     * @param $groupId
     * @return bool
     */
    public function deleteGroup($groupId): bool
    {
        // TODO: Implement deleteGroup() method.
    }

    /**
     * @return array
     */
    public function listAllGroups(): array
    {
        // TODO: Implement listAllGroups() method.
    }

    /**
     * @param array $details
     * @return bool
     */
    public function editGroupDetails(array $details): bool
    {
        // TODO: Implement editGroupDetails() method.
    }
}