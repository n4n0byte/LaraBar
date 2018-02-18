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

use App\Model\UserModel;
use App\Services\Data\Utilities\DataEdit;
use App\Services\Data\Utilities\DataRetrieval;
use App\Services\DatabaseAccess;
use PDO;
use PDOException;

class UserProfileDataAccessService {
    private $conn, $ini;

    /**
     * UserDataAccessService constructor.
     */
    public function __construct() {
        $this->conn = DatabaseAccess::connect();
        $this->ini = parse_ini_file("db.ini", true);
    }

    /**
     * @return UserModel|bool|int
     */
    public function read() {
        return DataRetrieval::getUserProfileById(session('id'));
    }

    public function update($employmentHistory, $location, $education, $bio) {
        DataEdit::updateProfile($employmentHistory, $location, $education, $bio);
    }

    /**
     * @param UserModel $user
     * @return bool
     */
    public function create(UserModel $user) {
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