<?php
/**
 * Created by PhpStorm.
 * User: zuos
 * Date: 2019/1/30
 * Time: 17:34
 */

namespace sf\cache;


use sf\base\CacheInterface;

class FileCache implements CacheInterface
{
    public $cacheDir = __DIR__ . '/../../../app/runtime/cache/';
    public function buildKey($key)
    {
        if (!is_string($key)) {
            $key = json_encode($key);
        }
        return md5($key);
    }

    public function set($key, $value, $duration = 0)
    {
        $buildKey = $this->buildKey($key);
        return $this->write($buildKey, $value, $duration);
    }

    public function get($key)
    {
        $buildKey = $this->buildKey($key);
        $cacheFile = $this->cacheDir . $buildKey;
        // 1.查看文件的访问时间是否超时
        if (fileatime($cacheFile) < time()) {
            @unlink($cacheFile);
            return '';
        }

        // 2. 未超时，读取文件内容，超时，则删除文件
        return unserialize(file_get_contents($cacheFile));

    }

    public function write($buildKey, $value, $duration)
    {
        $cacheFile = $this->cacheDir . $buildKey;
        if (@file_put_contents($cacheFile, serialize($value),LOCK_EX) !== false) {
            $duration = $duration <=0 ? (time() + 31536000) : $duration;
            return touch($cacheFile, $duration);
        }

        return false;
    }

    public function exists($key)
    {
        $buildKey = $this->buildKey($key);

        $cacheFile = $this->cacheDir . $key;

        if (file_exists($cacheFile) && fileatime($cacheFile) < time()) {
            return true;
        }
        return false;
    }

    public function mget($keys)
    {
        $result = [];
        foreach ($keys as $key) {
            $result[$key] = $this->get($key);
        }

        return $result;
    }

    public function mset($items, $duration)
    {
        $failedKeys = [];
        foreach ($items as $key=>$item) {
            if ($this->set($key, $item, $duration) === false) {
                $failedKeys[] = $key;
            }
        }

        return $failedKeys;
    }

    public function delete($key)
    {
        if ($this->exists($key)) {
            //1.存在就删除该文件
            $buildKey = $this->buildKey($key);
            $cacheFile = $this->cacheDir . $buildKey;
            if (unlink($cacheFile)) {
                return true;
            }
        }

        return false;
    }

    public function flush()
    {
        // 读取缓存目录下所有文件目录，挨个删除
        $dir = dir($this->cacheDir);

        while (($file = $dir->read()) !== false) {
            if ($file !== '.' && $file !== '..' && is_file($file)) {
                unlink($this->cacheDir . $file);
            }
        }

        return true;
    }
}