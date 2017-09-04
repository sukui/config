<?php
namespace Zan\Framework\Foundation\Core;

class ConfigLoader
{
    public function load($path ,$ignoreStructure = false)
    {
        \ZanPHP\Config\ConfigLoader::load($path ,$ignoreStructure);
    }

    public function loadDistinguishBetweenFolderAndFile($path)
    {
        \ZanPHP\Config\ConfigLoader::loadDistinguishBetweenFolderAndFile($path);
    }
}