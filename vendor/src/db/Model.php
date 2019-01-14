<?php
/**
 * Created by PhpStorm.
 * User: zuos
 * Date: 2019/1/7
 * Time: 20:15
 */

namespace sf\db;


class Model implements ModelInterface
{
    public static $pdo;
    
    public function __construct()
    {
       $dbClass = static::getDb();
        if (self::$pdo == null)
            self::$pdo = $dbClass->pdo;

        return self::$pdo;
    }

    public static function getDb()
    {
        return \Sf::$container->get('db');
    }

    public static function tableName()
    {
        return static::tableName();
    }

    public function save()
    {

        self::$pdo->query();
    }


    public static function findOne($condition)
    {
        $statement = 'select * from ' . self::tableName();
        $ret = self::$pdo->query($statement);
        var_dump($ret);
    }

//    public static function primaryKey()
//    {
//
//    }
//
//    public static function findAll($condition);
//
//    public static function updateAll($condition, $attributes);
//
//    public static function deleteAll($condition);
//
//    public function insert();
//
//    public function update();
//
//    public function delete();
}