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

use Illuminate\Database\Connection;
use App\Model\UserModel;
use PDO;
use PDOException;

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
     * @param $user
     * @param bool $limit
     * @return mixed
     */
    public function read(UserModel $user, $limit = TRUE)
    { // $limit should control if one or all users are selected
        $email = $user->getEmail();
        $password = $user->getPassword();
        // build query
        $query = $this->ini['User']['Select'];
        $statement = $this->conn->prepare($query);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        try {
            $statement->execute();

            // TODO: return all user properties
            return $statement->rowCount() == 1;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::findByUser" . $e->getMessage());
        }
    }

    public function create($user)
    {

    }
}