<?php
/**
 * version 2.0
 *
 * Student Name: Connor
 * Course Number: CST-256
 * Date: 3/1/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

namespace App\Services\Business;

use App\Model\UserModel;
use App\Services\Data\UserDataAccessService;
use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
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

    /**
     * @var UserModel
     */
    private $service, $status = "";

    /**
     * UserBusinessService constructor.
     */
    public function __construct()
    {
        LarabarLogger::info("UserBusinessService constructed", []);
        $this->service = new UserDataAccessService();
    }

    /**
     * used: 2
     * Find a user in the database
     * @param $data
     * @return UserModel|bool|int
     */
    public function login($data)
    {
        LarabarLogger::info("-> UserBusinessService::login");

        // select user from data source
        $user = $this->service->read($data);

        // check that a user was found
        if ($user) {
            LarabarLogger::info("UserBusinessService: Login success");
            return $user;
        }
        LarabarLogger::info("UserBusinessService: Login fail");

        // return false if no user found
        $this->status = "Invalid credentials. Please try again";
        return FALSE;
    }

    /**
     * used: 1
     * Add a user to the database
     * @param $data
     * @return UserModel|bool|int
     */
    public function register($data)
    {
        LarabarLogger::info("-> UserBusinessService::register");

        // check that passwords match
        if ($data['password'] != $data["confirmPassword"]) {
            $this->status = "Passwords do not match";
            return false;
        }


        // check for illegal characters
        if (!$this->inputIsValid($data)) {
            $this->status = "Illegal characters";
            return FALSE;
        }

        // insert user with defaults (ID, ADMIN)
        $result = $this->service->create($data);

        // return false if username taken
        if (!$result) {
            LarabarLogger::info("UserBusinessService: Register fail");
            $this->status = "Username taken";
            return false;
        }

        // else, log in new user
        LarabarLogger::info("UserBusinessService: Register success");
        return $this->login($data);
    }

    /**
     * @param $data
     * @return bool|int
     */
    public function inputIsValid($data)
    {
        LarabarLogger::info("-> UserBusinessService::inputIsValid");

        // define characters that are not allowed
        $invalidChars = array("\"", "'", "\\", "*", "/", "=");

        // run character checks
        foreach ($data as $param)
            foreach ($invalidChars as $c) {
                if (str_contains($param, $c)) {
                    $this->status = "Invalid characters: <pre>\" ' \\ * / =</pre>. " .
                        "Please make sure you do not use these in your password, email, or name.";
                    LarabarLogger::warning("UserBusinessService: invalid input ($param->$c)");

                    return -1;
                }
            }
        return TRUE;
    }

    /**
     * Used: 1
     * Gets all users as an array
     * @return array
     */
    public function listUsers()
    {
        LarabarLogger::info("-> UserBusinessService::listUsers");
        // get all from data access service as a 2D array
        $list = $this->service->readAll();

        // convert to UserModel array
        $users = array();
        $i = 0;

        // iterate through list and add to a UserModel array
        foreach ($list as $item) {
            $users[$i] = new UserModel($item["ID"], $item["EMAIL"]);
            $users[$i++]->setAdmin($item["ADMIN"]);
        }

        // return array
        return $users;
    }

    /**
     * @param $data
     */
    public function updateUserInfo($data)
    {
        $svc = new UserDataAccessService();
        $svc->update($data);
    }

    /**
     * used: 1
     * Delete a user from the database
     * @param $id
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteUser($id)
    {
        LarabarLogger::info("-> UserBusinessService::deleteUser");
        // call delete method from the data access service
        $result = $this->service->delete($id);

        // set status
        $this->status = $result ? "Successfully deleted " : "Failed to delete ";

        // return true if successful
        return $result;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


}

