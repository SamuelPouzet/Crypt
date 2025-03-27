<?php

namespace SamuelPouzet\Crypt\Options;

use SamuelPouzet\Crypt\Exception\InvalidArgumentException;

abstract class Option
{
    public static function checkOptions(array $options): array
    {
        $optionsChecked = [];
        foreach ($options as $key => $value) {
            $key = strtolower($key);
            $method = 'check' . str_replace('_', '', ucwords($key, '_'));

            if (! method_exists(static::class, $method)) {
                throw new InvalidArgumentException(sprintf('The option "%s" is unknown.', $key));
            }
            $optionsChecked[$key] = $value;
        }
        return $optionsChecked;
    }
}