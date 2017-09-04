<?php

namespace Zan\Framework\Foundation\Core;

class IronConfig
{
    public static function init()
    {
        \ZanPHP\Config\IronConfig::init();
    }

    public static function get($key, $default = null)
    {
        \ZanPHP\Config\IronConfig::get($key, $default);
    }

}