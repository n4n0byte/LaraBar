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

namespace App\Model;

use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOStatement;

/**
 * Class UserModel
 * @package App\Model
 */
class UserModel
{
    private $id;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $avatar;
    private $admin;

    /**
     * User constructor.
     * @param $id
     * @param $email
     * @param $password
     * @param $firstName
     * @param $lastName
     */
    public function __construct($id, $email = "", $password = "", $firstName = "", $lastName = "")
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        LarabarLogger::info("UserModel constructed: [$id, $email, $password, $firstName, $lastName]");
    }

    /**
     * @return array
     */
    public static function getFields()
    {
        return ['ID', 'Email', 'First Name', 'Last Name', 'Admin'];
    }

    /**
     * @return array
     */
    public function getJobFieldsArr()
    {
        return [$this->id, $this->email, $this->firstName, $this->lastName, $this->admin];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $url
     */
    public function setAvatar($url)
    {
        $this->avatar = $url;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }


}