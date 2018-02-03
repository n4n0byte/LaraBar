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

use App\Model\UserModel;
use App\Services\Data\UserDataAccessService;
use App\Services\DatabaseAccess;
use PDOException;

/**
 * Class UserBusinessService
 * @package App\Services\Business
 *
 * Errors:
 *      -1 => Invalid input (email and/or password)
 *      -2 => Blank trim(input)
 *      -11 => Username taken
 */
class UserBusinessService
{

    private $user;

    /**
     * UserBusinessService constructor.
     * @param UserModel $user
     */
    public function __construct(UserModel $user)
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

    /**
     * @return UserModel|bool|int
     */
    public function register()
    {
        if (!$this->inputIsValid())
            return false;
        try {

            // Data Access Service
            $das = new UserDataAccessService(DatabaseAccess::connect());

            // return success
            $status = $das->create($this->user);
            return $status;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityBSO::login {\n" .
                $e->getMessage() . "\n}");
        }
    }

    /**
     * @return bool|int
     */
    public function inputIsValid()
    {
        // define characters that are not allowed
        $invalidChars = array("\"", "'", "\\", "*", "/", "=");

        // run character checks
        foreach ((array)$this->user as $param)
            foreach ($invalidChars as $c)
                if (strpos($param, $c))
                    return -1;
        return TRUE;
    }
}

