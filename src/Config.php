<?php

namespace ZanPHP\Config;

use ZanPHP\Container\Container;
use ZanPHP\Contracts\Config\ConfigLoader as ConfigLoaderContract;
use ZanPHP\Support\Arr;

class Config
{
    private static $configMap = [];

    private static function load($path, $runMode)
    {
        $shareConfigMap = $runModeConfig = [];

        $sharePath = $path . 'share/';
        if (is_dir($sharePath)) {
            $shareConfigMap = ConfigLoader::getInstance()->load($sharePath);
        }

        $runModeConfigPath = $path . $runMode;
        if (is_dir($runModeConfigPath)) {
            $runModeConfig = ConfigLoader::getInstance()->load($runModeConfigPath);
        }

        return Arr::merge($shareConfigMap, $runModeConfig);
    }

    private static function loadPrivate($path)
    {
        $runMode = getenv("runMode");
        if (!in_array($runMode, ["pre", "online"], true)) {
            $privatePath = $path . '.private/';
            if (is_dir($privatePath)) {
                return ConfigLoader::getInstance()->load($privatePath);
            }
        }
        return [];
    }

    public static function init()
    {
        $configMaps = [];

        $paths = [
            getenv("path.zan"),
            getenv("path.config"),
            getenv("path.module"),
        ];

        $container = Container::getInstance();
        $container->instance(ConfigLoaderContract::class, ConfigLoader::getInstance());

        $runMode = getenv("runMode");
        foreach ($paths as $path) {
            $configMaps[] = self::load($path, $runMode);
        }

        foreach ($paths as $path) {
            $configMaps[] = self::loadPrivate($path);
        }

        self::$configMap = Arr::merge(self::$configMap, ...$configMaps);
    }

    public static function get($key, $default = null)
    {
        $preKey = $key;
        $routes = explode('.', $key);
        if (empty($routes)) {
            return $default;
        }

        $result = &self::$configMap;
        $hasConfig = true;
        foreach ($routes as $route) {
            if (!isset($result[$route])) {
                $hasConfig = false;
                break;
            }
            $result = &$result[$route];
        }
        if (!$hasConfig) {
            return IronConfig::get($preKey, $default);
        }
        return $result;
    }

    public static function set($key, $value)
    {
        $routes = explode('.', $key);
        if (empty($routes)) {
            return false;
        }

        $newConfigMap = Arr::createTreeByList($routes, $value);
        self::$configMap = Arr::merge(self::$configMap, $newConfigMap);

        return true;
    }

    public static function clear()
    {
        self::$configMap = [];
    }

    public static function all()
    {
        return self::$configMap;
    }
}
