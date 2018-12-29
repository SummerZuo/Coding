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
    /**
     * 注册异常处理函数
     */
    public function setExceptionHandler($exceptionHandler)
    {
        
        if (is_callable($exceptionHandler)) {
            set_exception_handler($exceptionHandler);
        }

    }
    
    
}