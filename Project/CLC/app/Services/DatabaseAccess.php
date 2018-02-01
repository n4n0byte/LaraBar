<?php

namespace App\Services;

use PDO;

class DatabaseAccess
{
    public static function connect()
    {
        $configuration = "database.connections.mysql.";
        $host = config($configuration . "host");
        $username = config($configuration . "username");
        $password = config($configuration . "password");
        $database = config($configuration . "database");
        $conn = new PDO("mysql:host=$host; dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}