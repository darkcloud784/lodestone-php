<?php

namespace Lodestone\Modules;

/**
 * This is very simple, doesn't follow PSR-3
 * todo: follow http://www.php-fig.org/psr/psr-3/
 * Class Logger
 */
class Logger
{
    public static $startTime = false;
    public static $lastTime = 0;
    public static $duration = 0;
    public static $log = [];

    /**
     * @param $class
     * @param $line
     * @param $message
     */
    public static function write($class, $line, $message)
    {
        $ms = substr(microtime(true), -4);
        $line = sprintf("[%s-%s][%s][%s] %s\n", date("Y-m-d H:i:s"), $ms, $class, $line, $message);
        self::$log[] = $line;

        // only output if enabled
        if (defined('LOGGER_ENABLED') && LOGGER_ENABLED) {
            echo $line;
        }
    }

    /**
     * @param $msg
     */
    public static function printtime($function, $line)
    {
        if (!defined('LOGGER_ENABLE_PRINT_TIME') || !LOGGER_ENABLE_PRINT_TIME) {
            return;
        }

        if (!self::$startTime) {
            self::$startTime = microtime(true);
        }

        $finish = microtime(true);
        $difference = $finish - self::$lastTime;
        $difference = str_pad(round($difference < 0.0001 ? 0 : $difference, 6), 10, '0');
        self::$lastTime = $finish;

        // unlikely something took 1000 seconds...
        // so hacky :D
        if ($difference > 1000) {
            $difference = '0000000000';
        }

        // duration
        $duration = $finish - self::$startTime;
        $duration = str_pad(round($duration < 0.0001 ? 0 : $duration, 6), 10, '0');
        self::$duration = $duration;

        // memory
        $memory = memory_get_usage();
        $memoryString = str_pad(number_format($memory), 15, ' ');

        // spacing
        $line = str_pad($line, 5, ' ');
        $flag = $difference > 0.002 ? '!' : ' ';
        $flag = $memory > (1024 * 1024 * 5) ? '!' : $flag; // over 5 mb?


        $string = "Duration: %s   + %s  %s    Mem: %s  Line %s in  %s\n";
        echo sprintf($string, $duration, $difference, $flag, $memoryString, $line, $function);
    }
}