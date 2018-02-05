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
use PDO;
use PDOException;

class DataRetrieval {

    private static $iniPath = "app/Services/Data/db.ini";

    static function getParsedIni(){
        return  parse_ini_file(self::$iniPath, true);
    }

    static function getModelByUID($id){
        $conn = DatabaseAccess::connect();

        // build query
        $query = self::getParsedIni()['User']['select'] . " ID = :id;";
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
                $user->setAvatar($assoc_array["AVATAR"]);
                return $user;
            } else {
                exit("Error");
            }
            return FALSE;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }



    static function getUserModelByAttr($colName, $varName){

        $conn = DatabaseAccess::connect();

        // build query
        $query = self::getParsedIni()['User']['select'] . " $colName = :var;";
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
                $user->setAvatar($assoc_array["AVATAR"]);
                return $user;
            } else {
                exit("Error");
            }
            return FALSE;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }


    public static function getUserProfileById(){
        $id = session('UID');

        $conn = DatabaseAccess::connect();

        // build query
        $query = self::getParsedIni()['UserProfile']['select'];
        $statement = $conn->prepare($query);
        $statement->bindParam(":id", $id);
        $userProfile = null;

        try {
            $statement->execute();
            $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);

            // make sure values were returned
            if ($assoc_array) {
                $userProfile = new UserProfileModel($assoc_array["AVATAR"], $assoc_array["BIO"],$assoc_array["LOCATION"], $assoc_array["EDUCATION"]);
                $user = self::getModelByUID($id);
                return ['user' => $user, 'userProfile' => $userProfile];
            } else {
                exit("Error");
            }
            return FALSE;
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }


    }

}