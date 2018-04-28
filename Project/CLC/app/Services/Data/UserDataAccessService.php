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
use App\User;
use PDO;
use PDOException;

class UserDataAccessService
{
    private $conn, $ini;

    /**
     * UserDataAccessService constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->conn = DatabaseAccess::Connect();
        $this->ini = parse_ini_file("db.ini", true);
        LarabarLogger::info("UserDataAccessService constructed", []);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function selectUserById($id)
    {
        // get sql statement from ini
        $query = $this->ini["Users"]["select.id"];
        $statement = $this->conn->prepare($query);

        // bind id to statement
        $statement->bindParam(":id", $id);
        try {

            // execute: return as associative array
            $statement->execute();
            $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);
            return $assoc_array;

        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::create\n" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * Selects a row from the user table with matching email and password
     * @param $data
     * @return UserModel|bool
     */
    public function read($data)
    {
        // get input values for email and password
        LarabarLogger::info("-> UserDataAccessService::read");
        $email = $data["email"];
        $password = $data["password"];

        // build query
        $query = $this->ini['Users']['select.login'];
        $statement = $this->conn->prepare($query);

        // bind email and password to query
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        try {

            // execute and check that 1 row was returned
            $statement->execute();
            if ($statement->rowCount() != 1)
                return false;
            $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);

            // make sure values were returned (check if null) and build user object
            $user = new UserModel($assoc_array["ID"]);
            session()->put(['UID' => $user->getId()]);
            $user->setEmail($assoc_array["EMAIL"]);
            $user->setPassword($assoc_array["PASSWORD"]);
            if (!is_null($assoc_array["FIRSTNAME"]))
                $user->setFirstName($assoc_array["FIRSTNAME"]);
            if (!is_null($assoc_array["LASTNAME"]))
                $user->setLastName($assoc_array["LASTNAME"]);
            if (!is_null($assoc_array["ADMIN"]))
                $user->setAdmin($assoc_array["ADMIN"]);

            // add user to session
            session()->put(['user' => $user]);
            session()->save();
            return $user;
        } catch (PDOException $e) {
            LarabarLogger::error("SecurityDAO::read error: " . $e->getMessage());
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }

    /**
     * Used: 1
     * Gets all users from the database
     * @return array
     */
    public function readAll()
    {
        // get sql statement from ini
        $query = $this->ini["Users"]["select.all"];
        $statement = $this->conn->prepare($query);
        try {

            // execute: return both (associative and indexed) array
            $statement->execute();
            $assoc_array = $statement->fetchAll();

            // return User table data
            return $assoc_array;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::readAll" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * update a row in the user table
     * @param $data
     */
    public function update($data)
    {
        LarabarLogger::info("-> UserDataAccessService::update");

        // define params from input
        $email = $data["email"];
        $password = $data["password"];
        $firstName = $data["firstName"];
        $lastName = $data["lastName"];
        $id = $data["id"];

        // get query from ini
        $query = $this->ini["Users"]["update.id"];
        $statement = $this->conn->prepare($query);

        // bind user params
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':firstName', $firstName);
        $statement->bindParam(':lastName', $lastName);
        $statement->bindParam(':id', $id);


        try {

            // execute update
            $statement->execute();

            // overwrite the user in the session with the updated credentials
            $user = new UserModel($id, $email, $password, $firstName, $lastName);
            session()->forget('user');
            session()->put('user', $user);
            session()->save();
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::create\n" . $e->getMessage());
        }


    }

    /**
     * used: 1
     * Add a new row to the user table
     * @param $data
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($data)
    {
        LarabarLogger::info("-> UserDataAccessService::create", $data);

        // First, check that a user with the entered email does not exist
        // define params
        $email = $data["email"];
        $password = $data["password"];
        $firstName = $data["firstName"];
        $lastName = $data["lastName"];

        // Check for unique email: select query from ini
        $query = $this->ini['Users']['select.email'];
        $statement = $this->conn->prepare($query);

        // bind email param
        $statement->bindParam(":email", $email);
        try {
            LarabarLogger::info("UserDataAccessService::create executing statement (select.email)");

            // execute query. Return true if email is unique.
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|int
     */
    public function delete($id)
    {
        LarabarLogger::info("-> UserDataAccessService::delete");
        try {
            // delete user profile components
            // Education
            LarabarLogger::info("UserDataAccessService::delete education");
            $query = "DELETE FROM EDUCATION WHERE USER_PROFILE_ID = :id"; // query to be executed
            $statement = $this->conn->prepare($query); // sql added to PDO statement
            $statement->bindParam(":id", $id); // user id bound to param
            $statement->execute(); // execution

            // Employment History
            LarabarLogger::info("UserDataAccessService::delete employment history");
            $query = "DELETE FROM EMPLOYMENT_HISTORY WHERE USER_PROFILE_ID = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(":id", $id);
            $statement->execute();

            // Skills
            LarabarLogger::info("UserDataAccessService::delete skills");
            $query = "DELETE FROM SKILLS WHERE USER_PROFILE_ID = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(":id", $id);
            $statement->execute();

            // Profile
            LarabarLogger::info("UserDataAccessService::delete profile");
            $query = "DELETE FROM USER_PROFILES WHERE USER_ID = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(":id", $id);
            $statement->execute();

            // Groups
            LarabarLogger::info("UserDataAccessService::delete from groups");
            $query = "DELETE FROM JOIN_USER_GROUP WHERE USER_ID = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(":id", $id);
            $statement->execute();

            // get sql query statement from ini
            LarabarLogger::info("UserDataAccessService::delete user");
            $query = $this->ini["Users"]["delete.id"];
            $statement = $this->conn->prepare($query);
            $statement->bindParam(":id", $id);

            // return 1 if successful, 0 if not
            return $statement->execute() ? 1 : 0;
        } catch (PDOException $e) {
            LarabarLogger::error("Exception in SecurityDAO::delete\n" . $e->getMessage());
            return view("error");
        }
    }
}