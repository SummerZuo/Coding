<?php
/**
 * 对象基础方法
 */

namespace sf\base;

class Object
{
    public function __get($name)
    {
        if (method_exists($this, "get{$name}")) {
            $methodName = "get{$name}";
            return $this->$methodName;
        }
    }
    
    public function __set($name, $value)
    {
        /** @todo 判断是否为私有属性 */
        if (method_exists($this, "set{$name}")) {
            $methodName = "set{$name}";
            return $this->$methodName($value);
        }
    }
}

