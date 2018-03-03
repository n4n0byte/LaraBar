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

use App\Services\BusinessInterfaces\IAdminGroupsBusinessService;

class AdminGroupsBusinessServiceSingletonDummy implements IAdminGroupsBusinessService {

    private static $instance = null;
    private $groups = array();
    private $users = array();

    public static function getInstance(): IAdminGroupsBusinessService {

        if (self::$instance == null){
            self::$instance = new AdminGroupsBusinessServiceSingletonDummy();
        }

        return self::$instance;
    }

    private function __construct() {
        //todo add stuff
    }



    public function createGroup(array $details): bool {
        // TODO: Implement createGroup() method.
        return true;
    }

    public function deleteGroup($groupId): bool {
        // TODO: Implement deleteGroup() method.
        return true;
    }

    public function listAllGroups(): array {
        // TODO: Implement listAllGroups() method.
        return [];
    }

    public function editGroupDetails(array $details): bool {
        // TODO: Implement editGroupDetails() method.
        return true;
    }

}