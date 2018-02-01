<?php
/**
 * version 1.0
 *
 * Student Name: Connor
 * Course Number: CST-256
 * Date: 1/31/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

namespace App\Services\Business;

use App\Services\Data\UserDataAccessService;
use App\Services\DatabaseAccess;
use PDOException;

class UserBusinessService
{

    private $user;

    /**
     * UserBusinessService constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function login()
    {
        try {
            $das = new UserDataAccessService(DatabaseAccess::connect());
            return $das->read($this->user);
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityBSO::login {\n" .
                $e->getMessage() . "\n}");
        }
    }


    public function register()
    {
        try {
            // TODO: add security checks

            // Data Access Service

            // check for username (use read)

            // return success
        } catch (Exception $e) {
            throw new Exception("Exception in SecurityBSO::login {\n" .
                $e->getMessage() . "\n}");
        }
    }
}

