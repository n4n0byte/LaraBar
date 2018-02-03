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

namespace App\Services\Data;

use App\Model\UserModel;
use PDO;
use PDOException;
use PDOStatement;

class UserDataAccessService
{
    private $conn, $ini;

    /**
     * UserDataAccessService constructor.
     * @param $conn
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
        $this->ini = parse_ini_file("db.ini", true);
    }

    /**
     * @param UserModel $user
     * @param bool $login
     * @return UserModel|bool|int
     */
    public function read(UserModel $user, $login = TRUE)
    { // $login should control if one or all users are selected
        $email = $user->getEmail();
        $password = $user->getPassword();

        // build query
        $query = $login ? $this->ini['User']['select.login'] : $this->ini['User']['select.all'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        try {
            $statement->execute();
            $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);

            // make sure values were returned
            if ($assoc_array) {
                $user->setId($assoc_array["ID"]);
                $user->setEmail($assoc_array["EMAIL"]);
                $user->setPassword($assoc_array["PASSWORD"]);
                $user->setFirstName($assoc_array["FIRSTNAME"]);
                $user->setLastName($assoc_array["LASTNAME"]);
                $user->setAvatar($assoc_array["AVATAR"]);
                return $user;

            }
            return FALSE;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }

    /**
     * @param UserModel $user
     * @return bool
     */
    public function create(UserModel $user)
    {
        // define params
        $email = $user->getEmail();
        $password = $user->getPassword();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $avatar = $user->getAvatar();

        // Check for unique email
        $query = $this->ini['User']['select'] . " EMAIL = :email ;";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":email", $email);
        try {
            $statement->execute();
            if ($statement->rowCount() > 0)
                return -11;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::create\n" . $e->getMessage());
        }
        var_dump($user);
        exit("");
        // build query
        $query = $this->ini['User']['create'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":firstname", $firstName);
        $statement->bindParam(":lastname", $lastName);
        $statement->bindParam(":avatar", $avatar);
        try {
            $statement->execute();
            // TODO: return all user properties
            return $statement->rowCount() == 1;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::findByUser\n" . $e->getMessage());
        }
    }
}