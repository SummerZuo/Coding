<?php
/**
 * Created by PhpStorm.
 * User: zuos
 * Date: 2018/12/28
 * Time: 11:12
 */
namespace app\exception;

class ExceptionHandler
{
    public static function handler($exception)
    {
        print "Uncaught exception: ".$exception->getMessage();
    }
}