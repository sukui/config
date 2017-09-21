<?php
/**
 * Created by PhpStorm.
 * User: huye
 * Date: 2017/9/18
 * Time: 上午11:43
 */

namespace ZanPHP\Config\Tests;

use ZanPHP\Config\Config;
use ZanPHP\Testing\UnitTest;

class ConfigTest extends UnitTest
{
    private $configPath;
    private $runMode;

    public function setUp()
    {
        parent::setUp();
        $this->runMode = getenv('runMode');
        $this->configPath = getenv('path.config');
        $path = __DIR__ . '/config/';
        putenv('runMode=test');
        putenv('path.config='.$path);
        Config::init();
    }

    public function tearDown()
    {
        parent::tearDown();
        putenv('runMode='.$this->runMode);
        putenv('path.config='.$this->configPath);
    }

    public function testGetConfigWork()
    {
        $data = Config::get('a.config');
        $this->assertEquals('share_a', $data, 'Config::get share failed');
        $data = Config::get('b.config');
        $this->assertEquals('test_b', $data, 'Config::get test failed');
        $data = Config::get('dir.c.config');
        $this->assertEquals('test_c', $data, 'Config::get test failed');
        Config::set('dir.c.config1','new');
        $data = Config::get('dir.c.config1');
        $this->assertEquals('new', $data, 'Config::set failed');
    }

}