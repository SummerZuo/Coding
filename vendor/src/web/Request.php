<?php
/**
 * 请求类
 */

namespace sf\web;

class Request
{
    /**
     * 获取get请求参数
     * @param $key
     * @param null $defaultValue
     */
    public function get($key, $defaultValue = null)
    {
        $value = isset($_GET[$key]) ? $_GET[$key] : $defaultValue;
        return $value;
    }

    /**
     * 获取post请求参数
     * @param $key
     * @param null $defaultValue
     */
    public function post($key, $defaultValue = null)
    {
        $value = $_POST[$Key];
        return $value ?: $defaultValue;
    }
}