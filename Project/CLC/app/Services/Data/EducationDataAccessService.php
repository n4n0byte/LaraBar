<?php
/*
version 1.0

Ali
CST-256
January 31, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
namespace App\Services\Data;

class EducationDataAccessService
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
     * @param $user
     * @return mixed
     */
    public function selectUserById(UserModel $user)
    {
        $query = $this->ini["Education"]["select"];
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
            session()->save();
            $user->setEmail($assoc_array["EMAIL"]);
            $user->setPassword($assoc_array["PASSWORD"]);
            if (!is_null($assoc_array["FIRSTNAME"]))
                $user->setFirstName($assoc_array["FIRSTNAME"]);
            if (!is_null($assoc_array["LASTNAME"]))
                $user->setLastName($assoc_array["LASTNAME"]);
            if (!is_null($assoc_array["AVATAR"]))
                $user->setAvatar($assoc_array["AVATAR"]);
            if (!is_null($assoc_array["ADMIN"]))
                $user->setAdmin($assoc_array["ADMIN"]);
            // TODO return warning if information is missing

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
        $query = $this->ini['Users']['select'] . " EMAIL = :email ;";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":email", $email);
        try {
            $statement->execute();
            if ($statement->rowCount() > 0) {
                return FALSE;
            }
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::create\n" . $e->getMessage());
        }

        // build query
        $query = $this->ini['Users']['create'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":firstname", $firstName);
        $statement->bindParam(":lastname", $lastName);
        $statement->bindParam(":avatar", $avatar);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::findByUser\n" . $e->getMessage());
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
            throw new PDOException("Exception in SecurityDAO::delete\n" . $e->getMessage());
        }
    }
}