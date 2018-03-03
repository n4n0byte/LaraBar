<?php
/**
 * version 2.0
 *
 * Student Name: Connor
 * Course Number: CST-256
 * Date: 2/1/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

namespace App\Services\Data;

use App\Model\UserModel;
use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOException;

class UserDataAccessService
{
    private $conn, $ini;

    /**
     * UserDataAccessService constructor.
     */
    public function __construct()
    {
        $this->conn = DatabaseAccess::Connect();
        $this->ini = parse_ini_file("db.ini", true);
        LarabarLogger::info("UserDataAccessService constructed", []);
    }

    /**
     * @param $user
     * @return mixed
     */
    public function selectUserById(UserModel $user)
    {
        $query = $this->ini["Users"]["select.id"];
        $statement = $this->conn->prepare($query);
        $id = $user->getId();
        $statement->bindParam(":id", $id);
        try {
            $statement->execute();
            $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);
            return $assoc_array;

        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::create\n" . $e->getMessage());
        }
    }

    /**
     * @param UserModel $user
     * @return UserModel|bool|int
     */
    public function read(UserModel $user)
    { // $login should control if one or all users are selected
        LarabarLogger::info("-> UserDataAccessService::read");
        $email = $user->getEmail();
        $password = $user->getPassword();

        // build query
        $query = $this->ini['Users']['select.login'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        try {
            $statement->execute();
            if ($statement->rowCount() != 1)
                return false;
            $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);
            // make sure values were returned
            $user->setId($assoc_array["ID"]);
            session()->put(['UID' => $user->getId()]);
            $user->setEmail($assoc_array["EMAIL"]);
            $user->setPassword($assoc_array["PASSWORD"]);
            if (!is_null($assoc_array["FIRSTNAME"]))
                $user->setFirstName($assoc_array["FIRSTNAME"]);
            if (!is_null($assoc_array["LASTNAME"]))
                $user->setLastName($assoc_array["LASTNAME"]);
            if (!is_null($assoc_array["ADMIN"]))
                $user->setAdmin($assoc_array["ADMIN"]);
            // TODO return warning if information is missing
            session()->put(['user' => $user]);
            session()->save();
            return $user;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }

    public function readAll()
    {
        $query = $this->ini["Users"]["select.all"];
        $statement = $this->conn->prepare($query);
        try {
            $statement->execute();
            $assoc_array = $statement->fetchAll();
            return $assoc_array;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::create\n" . $e->getMessage());
        }
    }

    public function update(UserModel $user)
    {

        // define params
        $email = $user->getEmail();
        $password = $user->getPassword();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $id = $user->getId();

        $query = $this->ini["Users"]["update.id"];
        $statement = $this->conn->prepare($query);

        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':firstName', $firstName);
        $statement->bindParam(':lastName', $lastName);
        $statement->bindParam(':id', $id);


        try {
            $statement->execute();
            session()->forget('user');
            session()->put('user', $user);
            session()->save();
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::create\n" . $e->getMessage());
        }


    }

    /**
     * @param UserModel $user
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(UserModel $user)
    {
        LarabarLogger::info("Entering UserDataAccessService::create", (array)$user);

        // First, check that a user with the entered email does not exist
        // define params
        $email = $user->getEmail();
        $password = $user->getPassword();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();

        // Check for unique email
        $query = $this->ini['Users']['select.email'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":email", $email);
        try {
            LarabarLogger::info("UserDataAccessService::create executing statement (select.email)");
            $statement->execute();
            if ($statement->rowCount() >= 1) {
                LarabarLogger::warning("UserDataAccessService::create email already used for an account");
                return FALSE;
            }
        } catch (PDOException $e) {
            LarabarLogger::error("Exception in SecurityDAO::create\n" . $e->getMessage());
            return view("error");
        }

        // Second, if email is unique, insert user.
        // build insert query
        LarabarLogger::info("UserDataAccessService::create preparing insert statement");
        $query = $this->ini['Users']['create'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":firstname", $firstName);
        $statement->bindParam(":lastname", $lastName);

        // attempt to insert a user
        try {
            LarabarLogger::info("UserDataAccessService::create executing statement (insert)");
            return $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("Exception in SecurityDAO::findByUser\n" . $e->getMessage());
            return view("error");
        }
    }

    public function delete(UserModel $user)
    {
        $query = $this->ini["Users"]["delete.id"];
        $statement = $this->conn->prepare($query);
        $id = $user->getId();
        $statement->bindParam(":id", $id);
        try {
            return $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("Exception in SecurityDAO::delete\n" . $e->getMessage());
            return view("error");
        }
    }
}