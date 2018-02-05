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

class DataEdit {

    public static function updateProfile($employmentHistory, $location, $education, $bio){

        $conn = DatabaseAccess::connect();
        $userProfile = DataRetrieval::getUserProfileById(session('UID'))['userProfile'];
        $id = session('UID');

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

    }
}