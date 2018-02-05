<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 2/4/2018
 * Time: 3:20 AM
 */

namespace App\Services\Data\Utilities;
use App\Model\UserModel;
use App\Services\DatabaseAccess;
use PDO;
use PDOException;

class DataRetrieval {

    private static $iniPath = "app/Services/Data/db.ini";

    public static function getParsedIni(){
        return  parse_ini_file(self::$iniPath, true);
    }

    public static function getModelByUID($id){
       return self::getUserModelByAttr("ID",$id);
    }

    public static function getUserModelByAttr($colName, $varName){

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

    public static function getUser(){

    }



}