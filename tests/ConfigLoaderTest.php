<?php
/**
 * Created by PhpStorm.
 * User: huye
 * Date: 2017/9/18
 * Time: 上午11:43
 */
namespace ZanPHP\Config\Tests;

use ZanPHP\Config\ConfigLoader;
use ZanPHP\Testing\UnitTest;

class ConfigLoaderTest extends UnitTest {

    public function test(){
        $config = new ConfigLoader();
        $result = $config->load(realpath(__DIR__ . '/config'));
        $this->assertEquals('share_a', $result['share']['a']['config'], 'ConfigLoader::load fail');
        $this->assertEquals('online_b', $result['online']['b']['config'], 'ConfigLoader::load fail');
        $this->assertEquals('online_c', $result['online']['dir']['c']['config'], 'ConfigLoader::load fail');
        $this->assertEquals('test_b', $result['test']['b']['config'], 'ConfigLoader::load fail');
        $this->assertEquals('test_c', $result['test']['dir']['c']['config'], 'ConfigLoader::load fail');
    }
}