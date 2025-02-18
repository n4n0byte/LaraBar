<?php
/**
 * Student Name: Connor Low
 * Course Number: CST-256
 * Date: 2/28/2018
 * This is my own work.
 */

namespace App\Services\Utility;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LarabarLogger implements ILogger
{
    private static $logger;

    static function getLogger()
    {
        if (self::$logger == null) {
            self::$logger = new Logger("MyApp");
            $stream = new StreamHandler("storage/logs/myapp.log", Logger::DEBUG);
            $stream->setFormatter(new LineFormatter("%datetime% : %level_name% : %message% : %context%\n", "g:iA n/j/Y"));
            self::$logger->pushHandler($stream);
        }
        return self::$logger;
    }

    public static function debug($message, $data = array())
    {
        self::getLogger()->debug($message, $data);
    }

    public static function info($message, $data = array())
    {
        self::getLogger()->info($message, $data);
    }

    public static function warning($message, $data = array())
    {
        self::getLogger()->warning($message, $data);
    }

    public static function error($message, $data = array())
    {
        self::getLogger()->error($message, $data);
    }
}