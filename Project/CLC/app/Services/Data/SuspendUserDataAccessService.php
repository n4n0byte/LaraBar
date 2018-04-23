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
use PDO;
use PDOException;

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
     * @param UserModel $user
     * @return bool
     */
    public function reactivate(UserModel $user)
    {
        $id = $user->getId();
        $query = $this->ini["SuspendedUsers"]["delete"];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $id);
        try {
            return $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in SuspendDAO::reactivate\n" . $e->getMessage());
        }
    }

    /**
     * Returns TRUE if suspended
     * @param UserModel $user
     * @return bool
     */
    public function checkSuspended(UserModel $user)
    {
        $id = $user->getId();
        $query = $this->ini["SuspendedUsers"]["select.id"];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $id);
        try {
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SuspendDAO::reactivate\n" . $e->getMessage());
        }
    }
}