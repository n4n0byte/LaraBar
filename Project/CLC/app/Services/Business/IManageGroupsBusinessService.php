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

interface IManageGroupsBusinessService
{
    /**
     * @return IManageGroupsBusinessService
     */
    static function getInstance();

    /**
     * if no value is passed, should use session-stored user
     * @param $user
     * @return GroupModel array
     */
    public static function listGroupsForUser(UserModel $user = null);

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

    /**
     * if no value is passed, should use session-stored user
     * @param array $users
     * @return bool
     */
    public static function addMembers(array $users = null);

    /**
     * if no value is passed, should use session-stored user
     * @param array $users
     * @return bool
     */
    public static function removeMembers(array $users = null);
}