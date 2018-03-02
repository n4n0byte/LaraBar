<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 2/28/2018
 * This is my own work.
 */

namespace App\Services\Utility;


interface ILogger
{
    static function getLogger();
    public static function debug($message, $data);
    public static function info($message, $data);
    public static function warning($message, $data);
    public static function error($message, $data);
}