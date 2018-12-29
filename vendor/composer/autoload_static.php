<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb2865d533abc622b796df7d170451c97
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'sf\\' => 3,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'sf\\' => 
        array (
            0 => __DIR__ . '/..' . '/src',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb2865d533abc622b796df7d170451c97::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb2865d533abc622b796df7d170451c97::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}