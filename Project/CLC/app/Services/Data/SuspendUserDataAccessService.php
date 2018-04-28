<?php
/*
version 1.1

Connor, Ali
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Services\Data;

use App\Model\UserModel;
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOException;

/**
 * Class SuspendUserDataAccessService
 * @package App\Services\Data
 */
class SuspendUserDataAccessService
{
    private $ini, $conn;

    /**
     * SuspendUserDataAccessService constructor.
     * @param $conn
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
        $this->ini = parse_ini_file("db.ini", true);
    }

    /**
     * @param UserModel $user
     * @return bool
     * @throws \Exception
     */
    public function suspend(UserModel $user)
    {
        // TODO check for existing suspended record

        // make sure user is not an admin
        $userDAS = new UserDataAccessService();
        $result = $userDAS->selectUserById($user->getId());

        if ($result["ADMIN"] == 1)
            return FALSE;

        // suspend user
        $id = $user->getId();
        $query = $this->ini["SuspendedUsers"]["create"];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $id);
        try {

            return $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in SuspendDAO::suspend\n" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * Remove a row from the suspended user table to reactivate
     * @param UserModel $user
     * @throws PDOException
     * @return bool
     */
    public function reactivate(UserModel $user)
    {
        // get id of reactivated user
        $id = $user->getId();

        // get query from ini and bind id param
        $query = $this->ini["SuspendedUsers"]["delete"];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $id);
        try {

            // execute and return true if successful
            return $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in SuspendDAO::reactivate\n" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * Checks if any rows in the suspended users table match the user id
     * Returns TRUE if suspended
     * @param UserModel $user
     * @throws PDOException
     * @return bool
     */
    public function checkSuspended(UserModel $user)
    {
        LarabarLogger::info("-> SuspendUserDataAccessService::checkSuspended (" .
            $user->getId() . ")");

        // initialize $id with user id
        $id = $user->getId();

        // get sql statement from ini and bind id param
        $query = $this->ini["SuspendedUsers"]["select.id"];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $id);
        try {

            // execute
            $statement->execute();

            // return true any rows matched criteria
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            LarabarLogger::error("SuspendUserDataAccessService::checkSuspended error: " .
                $e->getMessage());
            throw $e;
        }
    }
}