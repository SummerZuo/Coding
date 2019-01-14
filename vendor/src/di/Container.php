<?php
/**
 * Class Container
 * 用于解耦
 */

namespace sf\di;

use sf\base\Object;
use sf\exception\InvalidClassException;

class Container extends Object
{
    private $_definitions = [];

    private $config = [];

    private $instance = [];

    /**
     * 注册别名、类、接口
     * 作用：写入到私有变量中，后续调用，可以直接通过别名查找到实际类
     */
    public function register($class, $config = [])
    {
        if (empty($this->_definitions[$class])) {
            if (isset($config['class'])) {
                $this->_definitions[$class] = $config['class'];
                unset($config['class']);
            } else {
                $this->_definitions[$class] = $class;
            }
        }

        if (!empty($config) || $this->config[$class] != $config) {
            $this->config[$class] = $config;
        }
    }

    /**
     * 获取类
     * 作用：
     */
    public function get($class)
    {
        if (!isset($this->instance[$class])) {
            $this->make($class, empty($this->config[$class]) ? [] : $this->config[$class]);
        }
        return $this->instance[$class];
    }


    /**
     * 实例化类
     * 作用：通过名称，即可获取类实例；是真正实例化类的地方
     */
    public function make($class, $config=[], $_definitions = true)
    {
        if (isset($this->_definitions[$class])) {
            $class = $this->_definitions[$class];
        }

        if (!class_exists($class)) {
            throw new InvalidClassException("${class}:不存在");
        }

        $reflection = new \ReflectionClass($class);   // 反射类
        $constructor = $reflection->getConstructor(); // 构造函数
        $params = $this->getConstructorParams($constructor);

        if (!empty($config)) {
            $params[] = $config;
        }

        if (empty($params)) {
            $instance = $reflection->newInstance();
        } else {
            $instance = $reflection->newInstanceArgs($params);
        }

        if ($_definitions) {
            $this->instance[$class] = $instance;
        }

        return $instance;
    }

    public function getConstructorParams($constructor)
    {
        $params = [];
        if (!$constructor) {
            return $params;
        }
        $constructorParams = $constructor->getParameters();

        foreach ($constructorParams as $param) {
            $class = $param->getClass();
            $name = $param->getName();  // 变量名称
            if (is_object($class)){
                $params[$name] = $this->make($class->name);
            }
        }

        return $params;
    }
}