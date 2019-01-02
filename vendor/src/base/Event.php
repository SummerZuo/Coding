<?php
/**
 * 事件类
 */

namespace sf\base;


abstract class Event
{
    abstract public function listen();

    abstract public function trigger();
}