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

/**
 * Interface IManageGroupsBusinessService
 * @package App\Services\Business
 */
interface IAdminGroupsBusinessService
{
    /**
     * @return IAdminGroupsBusinessService
     */
    static function getInstance();

    /**
     * @param array $details
     * @return bool
     */
    public static function createGroup(array $details);

    /**
     * @param $group
     * @return bool
     */
    public static function deleteGroup($group);

    /**
     * @return GroupModel array
     */
    public static function listAllGroups();

    /**
     * @param array $details
     * @return bool
     */
    public static function editGroupDetails(array $details);

}