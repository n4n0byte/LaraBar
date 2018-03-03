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

namespace App\Services\BusinessInterfaces;

use App\Model\GroupModel;

/**
 * Interface IUserGroupsBusinessService
 * @package App\Services\BusinessInterfaces
 */
interface IUserGroupsBusinessService
{

    /**
     * @return IUserGroupsBusinessService
     */
    static function getInstance(): IUserGroupsBusinessService;

    /**
     * @param $user
     * @return array
     */
    public function listGroupsForUser($user): array;

    /**
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function addUserToGroup($userId, $groupId): bool;

    /**
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function removeUserFromGroup($userId, $groupId): bool;

    /**
     * return array of GroupModels
     * @return array
     */
    public function listAllAvailableGroups(): array;

    /**
     * returns array of groupModels
     * @param $groupId
     * @return array
     */
    public function listUserInGroup($groupId): array;

    /**
     * @return array
     */
    public function listAllGroups(): array;

}