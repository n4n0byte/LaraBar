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
 * Interface IManageGroupsBusinessService
 * @package App\Services\Business
 */
interface IAdminGroupsBusinessService
{

    /**
     * @return IAdminGroupsBusinessService
     */
    public static function getInstance(): IAdminGroupsBusinessService;


    /**
     * @param array $details
     * @return bool
     */
    public function createGroup(array $details): bool;

    /**
     * @param $groupId
     * @return bool
     */
    public function deleteGroup($groupId): bool;

    /**
     * @return array
     */
    public function listAllGroups(): array;

    /**
     * @param array $details
     * @return bool
     */
    public function editGroupDetails(array $details): bool;

    public function getGroup(array $id): GroupModel;

}