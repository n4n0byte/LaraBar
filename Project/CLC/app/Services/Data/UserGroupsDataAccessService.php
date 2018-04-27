<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 3/3/2018
 * This is my own work.
 */

namespace App\Services\Data;


use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
use PDOException;

class UserGroupsDataAccessService
{
    private static $ini;

    /**
     * @return mixed
     */
    public static function getIni()
    {
        if (self::$ini == null) {
            LarabarLogger::info("Init UserGroupsDataAccessService");

            // parse the db.ini file for queries
            self::$ini = parse_ini_file("db.ini", true);
        }
        return self::$ini;
    }

    /**
     * used: 1
     * Insert a new row into the user_group join table
     * @param $userId
     * @param $groupId
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public static function create($userId, $groupId)
    {
        LarabarLogger::info("-> UserGroupsDataAccessService::create", $groupId);

        // get query string
        $query = self::getIni()["JoinUsersGroups"]["insert.user"];

        // prepare query PDO statement
        $statement = DatabaseAccess::connect()->prepare($query);

        // bind parameters to variables
        $statement->bindParam(":userid", $userId);
        $statement->bindParam(":groupid", $groupId);

        // execute query
        try {
            LarabarLogger::info("UserGroupsDataAccessService::create executing statement");

            // return success
            return $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("Error in UserGroupsDataAccessService::create while trying to execute statement",
                $statement->queryString);
            return view("error");
        }
    }

    /**
     * used: 1
     * Select all rows from group table
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public static function read()
    {
        LarabarLogger::info("-> UserGroupsDataAccessService::read");

        // prepare query PDO statement
        $query = self::getIni()["Groups"]["select.all"];
        $statement = DatabaseAccess::connect()->prepare($query);

        // execute query
        try {
            LarabarLogger::info("UserGroupsDataAccessService::read executing statement");
            $statement->execute();

            // return ASSOC array
            return $statement->fetchAll();
        } catch (PDOException $e) {
            LarabarLogger::error("Error in UserGroupsDataAccessService::read while trying to execute statement",
                $statement->queryString);
            return view("error");
        }
    }

    /**
     * @param bool $withUser
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public static function readForUser($withUser = true)
    {
        LarabarLogger::info("Enter UserGroupsDataAccessService::readForUser using method: " .
            ($withUser ? "with user" : "without user"));

        // get User Id
        $id = session("user")->getId();
        $query = $withUser ? self::getIni()["JoinUsersGroups"]["select.groupHasUser"] :
            self::getIni()["JoinUsersGroups"]["select.groupSansUser"];

        // prepare query PDO statement
        $statement = DatabaseAccess::connect()->prepare($query);

        // bind parameters to variables
        $statement->bindParam(":id", $id);

        // execute query
        try {
            LarabarLogger::info("UserGroupsDataAccessService::readForUser executing statement");
            $statement->execute();

            // return ASSOC array
            return $statement->fetchAll();
        } catch (PDOException $e) {
            LarabarLogger::error("Error in UserGroupsDataAccessService::readForUser while trying to execute statement",
                [$statement->queryString]);
            return view("error");
        }
    }

    /**
     * used: 1
     * Get all rows from user_group join table with matching group id
     * @param $groupId
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public static function readForGroup($groupId)
    {
        LarabarLogger::info("-> UserGroupsDataAccessService::readForGroup");

        // get User Id
        $query = self::getIni()["JoinUsersGroups"]["select.userInGroup"];

        // prepare query PDO statement
        $statement = DatabaseAccess::connect()->prepare($query);

        // bind parameters to variables
        $statement->bindParam(":groupid", $groupId);

        // execute query
        try {
            LarabarLogger::info("UserGroupsDataAccessService::readForGroup executing statement");
            $statement->execute();

            // return ASSOC array
            return $statement->fetchAll();
        } catch (PDOException $e) {
            LarabarLogger::error("Error in UserGroupsDataAccessService::readForGroup while trying to execute statement",
                $statement->queryString);
            return view("error");
        }
    }

    /**
     * used: 1
     * Removes a row from the user_group join table
     * @param $userId
     * @param $groupId
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public static function delete($userId, $groupId)
    {
        LarabarLogger::info("-> UserGroupsDataAccessService::delete", [$userId, $groupId]);

        // get query string for join table delete row from ini
        $query = self::getIni()["JoinUsersGroups"]["delete.user"];

        // prepare query PDO statement
        $statement = DatabaseAccess::connect()->prepare($query);

        // bind user and group id params
        $statement->bindParam(":userid", $userId);
        $statement->bindParam(":groupid", $groupId);

        // execute query
        try {
            LarabarLogger::info("UserGroupsDataAccessService::delete executing statement");

            // return success
            return $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("Error in UserGroupsDataAccessService::delete while trying to execute statement",
                $statement->queryString);
            return view("error");
        }
    }
}