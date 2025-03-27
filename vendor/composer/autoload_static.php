<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1dfa4d1cca221a1ecfbac30941c2c298
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'samuelpouzet\\Crypt\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'samuelpouzet\\Crypt\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1dfa4d1cca221a1ecfbac30941c2c298::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1dfa4d1cca221a1ecfbac30941c2c298::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1dfa4d1cca221a1ecfbac30941c2c298::$classMap;

        }, null, ClassLoader::class);
    }
}
