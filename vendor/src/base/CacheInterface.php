<?php
/**
 * 缓存
 */

namespace sf\base;

interface CacheInterface
{
    /**
     * 生产唯一键
     */
    public function buildKey($key);

    public function get($key);

    public function set($key, $value, $duration = 0);

    public function exists($key);

    public function mget($keys);

    public function mset($items, $duration);

    public function delete($key);

    /**
     * 删除所有缓存
     */
    public function flush();
}