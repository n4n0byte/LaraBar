<?php
/**
 * version 1.1
 *
 * Student Name: Connor
 * Course Number: CST-256
 * Date: 3/3/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

namespace App\Services\Data;

use App\Services\DatabaseAccess;
use App\Services\Utility\LarabarLogger;
use PDOException;

/**
 * Class AdminGroupsDataAccessService
 * @package App\Services\Data
 */
class AdminGroupsDataAccessService
{
    private static $ini;

    /**
     * @return mixed
     */
    public static function getIni()
    {
        if (self::$ini == null) {
            LarabarLogger::info("Init AdminGroupsDataAccessService");

            // parse the db.ini file for queries
            self::$ini = parse_ini_file("db.ini", true);
        }
        return self::$ini;
    }

    /**
     * @param array $details
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function create(array $details)
    {
        LarabarLogger::info("Enter AdminGroupsDataAccessService::create", $details);

        // select query statement
        $query = self::getIni()['Groups']['insert'];
        $statement = DatabaseAccess::connect()->prepare($query);

        // bind parameters
        $statement->bindParam(":summary", $details["summary"]);
        $statement->bindParam(":title", $details["title"]);
        $statement->bindParam(":description", $details["description"]);

        // execute
        try {
            LarabarLogger::info("AdminGroupsDataAccessService::create executing statement");
            return $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("Error in AdminGroupsDataAccessService::create while trying to execute statement", $statement->queryString);
            return view("error");
        }
    }

    /**
     * @param $id
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function delete($id)
    {
        LarabarLogger::info("Enter AdminGroupsDataAccessService::delete", $id);

        // select query statement
        $query = self::getIni()['Groups']['delete'];
        $statement = DatabaseAccess::connect()->prepare($query);

        // bind parameters
        $statement->bindParam(":id", $id);

        // execute
        try {
            LarabarLogger::info("AdminGroupsDataAccessService::delete executing statement", $id);
            return $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("Error in AdminGroupsDataAccessService::delete while trying to execute statement", $statement->queryString);
            return view("error");
        }
    }

    /**
     * @param $details
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function update($details)
    {
        LarabarLogger::info("Enter AdminGroupsDataAccessService::update", $details);

        // select query statement
        $query = self::getIni()['Groups']['update'];
        $statement = DatabaseAccess::connect()->prepare($query);

        // bind parameters
        $statement->bindParam(":id", $details["id"]);
        $statement->bindParam(":summary", $details["summary"]);
        $statement->bindParam(":title", $details["title"]);
        $statement->bindParam(":description", $details["description"]);

        // execute
        try {
            LarabarLogger::info("AdminGroupsDataAccessService::update executing statement");
            return $statement->execute();
        } catch (PDOException $e) {
            LarabarLogger::error("Error in AdminGroupsDataAccessService::update while trying to execute statement", $statement->queryString);
            return view("error");
        }
    }

    /**
     * @param int $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function read($id = -1)
    {
        LarabarLogger::info("Enter AdminGroupsDataAccessService::read using method: " . ($id > 0 ? "where id = $id" : "no where"));

        // select query statement
        $query = $id < 1 ? self::getIni()['Groups']['select.all'] : self::getIni()['Groups']['select.id'];
        $statement = DatabaseAccess::connect()->prepare($query);

        // bind parameters
        $statement->bindParam(":id", $id);

        // execute
        try {
            LarabarLogger::info("AdminGroupsDataAccessService::read executing statement");
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            LarabarLogger::error("Error in AdminGroupsDataAccessService::read while trying to execute statement", $statement->queryString);
            return view("error");
        }
    }


}