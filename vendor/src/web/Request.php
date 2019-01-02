<?php
/**
 * 请求类
 *
 * 请求类加上事件
 */

namespace sf\web;

class Request extends \sf\base\Request
{
    /**
     * 获取get请求参数
     * @param $key
     * @param null $defaultValue
     */
    public function get($key = null, $defaultValue = null)
    {
        if (empty($key)) {
            $value = $_GET;
        } else {
            $value = isset($_GET[$key]) ? $_GET[$key] : $defaultValue;
        }
        return $value;
    }

    /**
     * 获取post请求参数
     * @param $key
     * @param null $defaultValue
     */
    public function post($key = null, $defaultValue = null)
    {
        if (empty($key) && $defaultValue !== null) {
            $value = $_POST;
        } else {
            $value = isset($_POST[$key]) ? $_POST[$key] : $defaultValue;
        }
        return $value;
    }

    /**
     * 获取所有参数
     */
    public function getAllRequestParams()
    {
        $getParams = $this->get();
        $postParams = $this->post();

        $paramsArr = array_merge($getParams, $postParams);
        return $paramsArr;
    }
}