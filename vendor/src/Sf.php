<?php
/**
 * 项目核心文件
 * 用于后续外部class与容器之间的交互
 */
require __DIR__ . "/BaseSf.php";

class Sf extends \sf\BaseSf
{

}

spl_autoload_register(['Sf', 'autoload'],true,true);

// 加载容器
Sf::$container = new sf\di\Container();