<?php
/**
 * Created by PhpStorm.
 * User: zuos
 * Date: 2018/12/27
 * Time: 20:36
 */

namespace sf;

use sf\base\Object;
use sf\di\Container;

class BaseSf extends Object
{
    /** @var $container Container */
    public static $container;

    /** @var $app Application */
    public static $app;

    public static function autoload($class)
    {
        if (class_exists($class)) {
            include "$class";
        }
    }

    public static function createObject($class)
    {
        return self::$container->get($class);
    }
}