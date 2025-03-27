<?php

namespace SamuelPouzet\Crypt\Options;

use SamuelPouzet\Crypt\Exception\InvalidArgumentException;

class Bcrypt extends Option
{

    public static function checkCost(int $cost): int
    {
        if ($cost < 4 || $cost > 31) {
            throw new InvalidArgumentException('Cost must be a positive integer in range 4-31');
        }
        return $cost;
    }

}