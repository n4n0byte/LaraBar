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

interface IUserGroupsBusinessService
{
    /**
     * @return IUserGroupsBusinessService
     */
    static function getInstance();

    /**
     * @param $user
     * @return GroupModel array
     */
    public static function listGroupsForUser(UserModel $user);

    /**
     * @param array $details
     * @return bool
     */
    public static function createGroup(array $details);
    public static function deleteGroup($group);
    public static function listAllGroups();
    public static function editGroupDetails(array $details);
    public static function addMembers(array $users);
}