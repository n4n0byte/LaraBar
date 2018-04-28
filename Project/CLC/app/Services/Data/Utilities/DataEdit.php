<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 2/4/2018
 * Time: 7:36 PM
 */

namespace App\Services\Data\Utilities;

use App\Model\UserProfileModel;
use App\Services\DatabaseAccess;
use App\Services\Data\Utilities\DataRetrieval;
use App\Services\Utility\LarabarLogger;
use PDO;
use PDOException;

class DataEdit
{

    public static function hasInfo()
    {
        $conn = DatabaseAccess::connect();
        $id = session('UID');
        $query = DataRetrieval::getParsedIni()['UserProfile']['check'];
        $statement = $conn->prepare($query);
        $statement->bindParam(':id', $id);
        $result = $statement->execute();
        $assoc_array = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->rowCount();
        return $statement->rowCount();
    }

    /**
     * used: 1
     * Insert or update a row in the user profile table
     * @param UserProfileModel $model
     * @throws \Exception
     */
    public static function updateProfile(UserProfileModel $model)
    {
        LarabarLogger::info("-> DataEdit::updateProfile");

        // establish connection and user id
        $conn = DatabaseAccess::connect();
        $id = session('UID');

        // Determine which sql statement to use. If a user already has a profile, update. Else, select.
        $hasInfo = self::hasInfo();
        $query = ($hasInfo > 0) ? DataRetrieval::getParsedIni()['UserProfile']['update'] :
            $query = DataRetrieval::getParsedIni()['UserProfile']['insert'];

        // Bind bio, location, user id
        $statement = $conn->prepare($query);
        $statement->bindParam(":bio", $model->getBio());
        $statement->bindParam(":location", $model->getLocation());
        $statement->bindParam(":id", $id);
        try {

            // execute update/insert
            $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Exception in SecurityDAO::read\n" . $e->getMessage());
        }
    }
}