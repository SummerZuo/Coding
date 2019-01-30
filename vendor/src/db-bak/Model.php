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

    public static $db;
    
    public function __construct()
    {
        self::$db = static::getDb();
//       $dbClass = static::getDb();
        if (self::$pdo == null)
            self::$pdo =  self::$db->getPdo();
//
//        return self::$pdo;
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

    }

    public function insert()
    {
        $command = self::$db->getCommand();
        $command->insert();

        $attributes = static::attributes();
        $fileds = array_keys($attributes);

        $pdo = new \PDO();
$sl = "insert into table_a ('id', 'name') values (?,?)";
$prepare = $pdo->prepare($sl);
$t = 0;

        foreach ($attributes as $value) {
            $t += 1;
            $prepare->bindParam($t, $value);
        }
        $sql = 'insert into ' . static::tableName() . "()";
//        $pdo->prepare('$sql');
//        self::$pdo->prepare
    }

    public static function query($sql)
    {
        return self::$pdo->query($sql);
    }

//    public static function findOne($condition)
//    {
//        self::$db->getQueryBuilder()->query($table, $condition);
//
//        $statement = 'select * from ' . self::tableName();
//        $ret = self::$pdo->query($statement);
//        var_dump($ret);
//    }

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