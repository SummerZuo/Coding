<?php
/**
 * 入口文件
 */

// 1.composer自动加载
require __DIR__ . "/../vendor/autoload.php";

// 2.框架核心文件
require __DIR__ . "/../vendor/src/Sf.php";

// 3.加载配置文件
$config = array_merge(
    require __DIR__ . '/../config/db.php',
    require __DIR__ . '/../config/params.php'
);

// 4.进入应用入口，将配置文件注入到Application中
$application = new sf\Application($config);
$application->run();