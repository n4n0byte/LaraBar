<?php
/**
 * version 1.1s
 *
 * Student Name: Connor
 * Course Number: CST-256
 * Date: 3/3/2018
 * This assignment was completed in collaboration with Connor Low, Ali Cooper.
 * We used source code from the following websites to complete this assignment: N/A
 */

// TODO move to \Utility
// TODO add ini getter function
namespace App\Services;

use PDO;

class DatabaseAccess
{
    public static function connect()
    {
            $conn = null;
            $configuration = "database.connections.mysql.";
            $host = config($configuration . "host");
            $username = config($configuration . "username");
            $password = config($configuration . "password");
            $database = config($configuration . "database");
            try{
                $conn = new PDO("mysql:host=$host; dbname=$database", $username, $password);
            } catch (\Exception $e){
                throw $e;
            }
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

    }
}