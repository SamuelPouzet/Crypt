<?php

namespace SamuelPouzet\Crypt\Options;

use SamuelPouzet\Crypt\Exception\InvalidArgumentException;

class Argon extends Option
{
    public static function checkMemoryCost(int $cost): int
    {
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