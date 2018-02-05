<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 2/4/2018
 * Time: 7:36 PM
 */

namespace App\Services\Data\Utilities;
use App\Services\DatabaseAccess;
use App\Services\Data\Utilities\DataRetrieval;
use PDO;

class DataEdit {

    public static function hasInfo(){
        $conn = DatabaseAccess::connect();
        $id = session('UID');
        $query = DataRetrieval::getParsedIni()['UserProfile']['check'];
        $statement = $conn->prepare($query);
        $statement->bindParam(':id',$id);
        $result = $statement->execute();
        $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->rowCount();
        return $statement->rowCount();
    }

    public static function updateProfile($employmentHistory, $location, $education, $bio){

        $conn = DatabaseAccess::connect();
        $id = session('UID');
        $hasInfo = self::hasInfo();

        if ($hasInfo > 0){
            // build query
            $query = DataRetrieval::getParsedIni()['UserProfile']['update'];
            $statement = $conn->prepare($query);
            $statement->bindParam(":bio", $bio);
            $statement->bindParam(":employmentHistory", $employmentHistory);
            $statement->bindParam(":location", $location);
            $statement->bindParam(":education", $education);
            $statement->bindParam(":id", $id);
            try {
                $statement->execute();
            } catch (PDOException $e) {
                throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
            }
        } else {
            // build query
            $query = DataRetrieval::getParsedIni()['UserProfile']['insert'];
            $statement = $conn->prepare($query);
            $statement->bindParam(":bio", $bio);
            $statement->bindParam(":employmentHistory", $employmentHistory);
            $statement->bindParam(":location", $location);
            $statement->bindParam(":education", $education);
            $statement->bindParam(":id", $id);
            try {
                $statement->execute();
            } catch (PDOException $e) {
                throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
            }
        }



    }
}