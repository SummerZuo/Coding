<?php
/**
 * Created by PhpStorm.
 * User: zuos
 * Date: 2019/1/7
 * Time: 20:48
 */

namespace app\Model;

class TableA extends \sf\db\Model
{
    public static function getDb()
    {
        return \Sf::$container->get('db');
    }

    public static function tableName()
    {
        return 'table_a';
    }

    public function attributes()
    {
        return get_object_vars($this);
    }

}