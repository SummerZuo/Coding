<?php
/**
 * 保存一些全局设置
 * User: zuos
 * Date: 2018/12/28
 * Time: 11:01
 */

namespace sf\base;

class Component extends Object
{
    private $_event = [];

    /**
     * 注册异常处理函数
     */
    public function setExceptionHandler($exceptionHandler)
    {

        if (is_callable($exceptionHandler)) {
            set_exception_handler($exceptionHandler);
        }

    }


    public function listen($name, $handler, $data = null, $append = true)
    {
        if ($append || empty($this->_event[$name])) {
            $this->_event[$name][] = [$handler, $data];
        } else {
            array_unshift($this->_event[$name], [$handler, $data]);
        }
    }

    public function trigger($name)
    {
//        $handler = isset($this->_event[$name]) ? $this->_event[$name] : [];
        if (isset($this->_event[$name])) {
            $eventHandlers = $this->_event[$name];
        }

        foreach ($eventHandlers as $handler) {
            call_user_func($handler[0], $handler[1]);
        }

    }
}