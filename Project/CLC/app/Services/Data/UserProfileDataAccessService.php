<?php
/**
 * version 1.0
 *
 * Student Name: Ali Cooper
 * Course Number: CST-256
 * Date: 1/31/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

namespace App\Services\Data;

use App\Model\UserProfileModel;
use App\Services\Data\Utilities\DataEdit;
use App\Services\Data\Utilities\DataRetrieval;
use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
use PDOException;

class UserProfileDataAccessService
{
    private $conn, $ini;

    /**
     * UserDataAccessService constructor.
     */
    public function __construct()
    {
        try {
            $this->conn = DatabaseAccess::connect();
            $this->ini = parse_ini_file("db.ini", true);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $id
     * @return \App\Model\UserModel|bool
     */
    public function getDataById($id)
    {
        return DataRetrieval::getModelByUID($id);
    }

    /**
     * used: 1
     * Get a user profile from the database
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function read($id)
    {
        LarabarLogger::info("-> UserProfileDataAccessService::read");

        // use static data retrieval method
        return DataRetrieval::getUserProfileById($id);
    }

    /**
     * used: 1
     * Update a user profile in the database
     * @param UserProfileModel $model
     * @throws \Exception
     */
    public function update(UserProfileModel $model)
    {
        LarabarLogger::info("-> UserProfileDataAccessService::update");
        // call static DataEdit method
        DataEdit::updateProfile($model);
    }


    /**
     * @param UserProfileModel $model
     * @throws PDOException
     * @return bool|int
     */
    public function create(UserProfileModel $model)
    {
        // Check for unique email
        $query = $this->ini['UserProfile']['insert'];
        $uid = session('UID');
        $location = "";
        $bio = "";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(":id", $uid);
        $statement->bindParam(":location", $location);
        $statement->bindParam(":bio", $bio);

        try {
            $statement->execute();
            if ($statement->rowCount() > 0)
                return -11;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::create\n" . $e->getMessage());
        }

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