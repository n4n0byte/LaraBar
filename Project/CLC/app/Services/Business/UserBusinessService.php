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
    private $user, $service, $status = "";

    /**
     * UserBusinessService constructor.
     * @param UserModel $user
     */
    public function __construct(UserModel $user)
    {
        LarabarLogger::info("UserBusinessService constructed", (array)$user);
        $this->user = $user;
        $this->service = new UserDataAccessService();
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
     * @return UserModel|bool|int
     */
    public function login()
    {
        LarabarLogger::info("-> UserBusinessService::login");

        // select user from data source
        $user = $this->service->read($this->user);

        // check for success.
        if ($user) {
            LarabarLogger::info("UserBusinessService: Login success");
            return $user;
        }
        LarabarLogger::info("UserBusinessService: Login fail");
        $this->status = "Invalid credentials. Please try again";
        return FALSE;
    }

    /**
     * @return UserModel|bool|int
     */
    public function register()
    {
        LarabarLogger::info("-> UserBusinessService::register");

        // check for illegal characters
        if (!$this->inputIsValid()) {
            return FALSE;
        }

        // insert user with defaults (ID, ADMIN)
        $result = $this->service->create($this->user);
        if (!$result) {
            LarabarLogger::info("UserBusinessService: Register fail");
            $this->status = "Username taken";
            return false;
        }

        // login
        LarabarLogger::info("UserBusinessService: Register success");
        return $this->login();
    }

    /**
     * @return bool|int
     */
    public function inputIsValid()
    {
        LarabarLogger::info("-> UserBusinessService::inputIsValid");

        // define characters that are not allowed
        $invalidChars = array("\"", "'", "\\", "*", "/", "=");

        // run character checks
        foreach ((array)$this->user as $param)
            foreach ($invalidChars as $c) {
                if (str_contains($param, $c)) {
                    $this->status = "Invalid characters: <pre>\" ' \\ * / =</pre>. " .
                        "Please make sure you do not use these in your password, email, or name.";
                    LarabarLogger::warning("UserBusinessService: invalid input");

                    return -1;
                }
            }
        return TRUE;
    }

    /**
     * @return array
     */
    public function listUsers()
    {
        // get all from data source
        $list = $this->service->readAll();

        // convert to UserModel array
        $users = array();
        $i = 0;
        foreach ($list as $item) {
            $users[$i] = new UserModel($item["ID"], $item["EMAIL"]);
            $users[$i++]->setAdmin($item["ADMIN"]);
        }

        // return array
        return $users;
    }

    /**
     * @param UserModel $model
     */
    public function updateUserInfo(UserModel $model)
    {
        $svc = new UserDataAccessService();
        $svc->update($model);
    }

    /**
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteUser()
    {
        $result = $this->service->delete($this->user);
        $this->status = $result ? "Successfully deleted " : "Failed to delete ";
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

