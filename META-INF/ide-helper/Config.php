<?php

namespace Zan\Framework\Foundation\Core;

class Config
{
    public static function init()
    {
        \ZanPHP\Config\Config::init();
    }

    public static function get($key, $default = null)
    {
        \ZanPHP\Config\Config::get($key, $default);
    }

    public static function set($key, $value)
    {
        \ZanPHP\Config\Config::set($key, $value);
    }

    public static function clear()
    {
        \ZanPHP\Config\Config::clear();
    }

    public static function all()
    {
        \ZanPHP\Config\Config::all();
    }

}
