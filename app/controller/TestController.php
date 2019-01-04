<?php
/**
 * Created by PhpStorm.
 * User: zuos
 * Date: 2018/12/28
 * Time: 16:31
 */
namespace app\controller;
class TestController extends \sf\web\Controller
{
    const AFTER_REGISTER = 'after_register';

    public function index($cc, $tt)
    {

        return 123;
    }

    public function register()
    {
        $this->listen(self::AFTER_REGISTER, [$this, 'sendMail']);
    }

    public function sendMail($mail)
    {

    }
}