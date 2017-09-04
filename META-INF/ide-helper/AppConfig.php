<?php

namespace Zan\Framework\Foundation\Core;

class AppConfig
{
    public static function init()
    {
        \ZanPHP\Config\AppConfig::init();
    }

    public static function get($key, $default = null)
    {
        \ZanPHP\Config\AppConfig::get($key, $default);
    }

    public static function set($key, $value)
    {
        \ZanPHP\Config\AppConfig::set($key, $value);
    }

    public static function clear()
    {
        \ZanPHP\Config\AppConfig::clear();
    }
}
