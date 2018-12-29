<?php

namespace app\exception;

use sf\BaseSf;

class Test
{
    public $c;
    public $t = [];
    private $base;
    public function __construct(BaseSf $baseSf1)
    {
        $this->base = $baseSf1;
    }
}