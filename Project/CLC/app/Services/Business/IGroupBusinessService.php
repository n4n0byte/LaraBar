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

interface IGroupBusinessService
{
    /**
     * @return IGroupBusinessService
     */
    static function getService();

    /**
     * @param null $criteria
     * @return GroupModel array
     */
    public static function listGroups($criteria = null);

    /**
     * @param $group
     * @return UserModel array
     */
    public static function listUsersFor($group);
}