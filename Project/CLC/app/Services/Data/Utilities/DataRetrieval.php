<?php
/*
version 1.0

Ali
CST-256
January 31, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

namespace App\Services\Data\Utilities;

use App\Model\UserModel;
use App\Model\UserProfileModel;
use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOException;

class DataRetrieval
{

    private static $iniPath = "app/Services/Data/db.ini";

    /**
     * used: often
     * Returns the parsed db.ini file with sql statements
     * @return array|bool
     */
    static function getParsedIni()
    {
        LarabarLogger::info("getParsedIni() called");
        return parse_ini_file(self::$iniPath, true);
    }

    /**
     *
     */
    static function hasProfile()
    {
        $id = session('uid');
        $conn = DatabaseAccess::connect();

        // build query
        $query = self::getParsedIni()['Users']['select.id'];
        $statement = $conn->prepare($query);
        $statement->bindParam(":id", $id);
        $user = new UserModel(0, "", "");
    }

    /**
     * @param $id
     * @return UserModel|bool
     */
    static function getModelByUID($id)
    {
        $conn = DatabaseAccess::connect();

        // build query
        $query = self::getParsedIni()['Users']['select.id'];
        $statement = $conn->prepare($query);
        $statement->bindParam(":id", $id);
        $user = new UserModel(0, "", "");

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
                return $user;
            } else {
                return null;
            }
            return FALSE;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }

    /**
     * @param $colName
     * @param $varName
     * @return UserModel|bool
     */
    static function getUserModelByAttr($colName, $varName)
    {

        $conn = DatabaseAccess::connect();

        // build query
        $query = self::getParsedIni()['Users']['select'] . " $colName = :var;";
        $statement = $conn->prepare($query);
        $statement->bindParam(":var", $varName);
        $user = new UserModel(0, "", "");

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
                return $user;
            } else {
                exit("Error");
            }
            return FALSE;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }

    /**
     * Returns an array containing a UserModel and a UserProfileModel
     * @return array
     */
    public static function getUserProfileByInputId($id)
    {
        $conn = DatabaseAccess::connect();

        // build query
        $query = self::getParsedIni()['UserProfile']['select'];
        $query = self::getParsedIni()['UserProfile']['select'];
        $statement = $conn->prepare($query);
        $statement->bindParam(":id", $id);
        $userProfile = null;

        try {
            $statement->execute();
            $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);

            $userProfile = new UserProfileModel($assoc_array["IMGURL"], $assoc_array["BIO"], $assoc_array["LOCATION"]);
            $user = self::getModelByUID($id);
            return array('user' => $user, 'userProfile' => $userProfile);

        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }

    /**
     * used: 1
     * Select a row from the user profile table with matching id
     * Returns an array containing a UserProfileModel.
     * @param $id
     * @return array
     * @throws \Exception
     */
    public static function getUserProfileById($id)
    {
        LarabarLogger::info("-> DataRetrieval::getUserProfileById");

        // connect to database
        $conn = DatabaseAccess::connect();

        // build query
        $query = self::getParsedIni()['UserProfile']['select'];
        $statement = $conn->prepare($query);

        // bind id param
        $statement->bindParam(":id", $id);
        try {

            // execute select statement and retrieve result as assoc array
            $statement->execute();
            $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);

            // create a new profile model and return data
            $userProfile = new UserProfileModel($assoc_array["IMGURL"], $assoc_array["BIO"], $assoc_array["LOCATION"]);
            $user = self::getModelByUID($id);
            return array('userProfile' => $userProfile);

        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }
}