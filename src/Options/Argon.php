<?php

namespace samuelpouzet\Crypt\Options;

use samuelpouzet\Crypt\Exception\InvalidArgumentException;

class Argon extends Option
{
    public static function checkMemoryCost(int $cost): int
    {
        if ($cost < 4 || $cost > 31) {
            throw new InvalidArgumentException('Cost must be a positive integer in range 4-31');
        }
        return $cost;
    }

    public static function checkTimeCost(int $time): int
    {
        return $time;
    }

    public static function checkThreads(int $threads): int
    {
        return $threads;
    }
}