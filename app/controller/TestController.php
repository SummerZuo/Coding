<?php
/**
 * Created by PhpStorm.
 * User: zuos
 * Date: 2018/12/28
 * Time: 16:31
 */
namespace app\controller;
use app\Model\LoginForm;

class TestController extends \sf\web\Controller
{

    public function index()
    {
        $model = new LoginForm();
        var_dump($model);
    }





    public function login()
    {
        $model = new LoginForm();
        // 这一步做了哪些操作？
        // 1.拿到连接DB相关参数, 直接从容器中拿到db类
        // 2.实例化Model类

        $res = $model->findOne();
        var_dump($res);
    }


}