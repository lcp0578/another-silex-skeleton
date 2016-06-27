<?php

/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016年6月23日 下午11:53:39
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
use Silex\WebTestCase;

class ApplicationTest extends WebTestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function createApplication()
    {
        $app = require __DIR__ . '../../app/app.php';
        $app['debug'] = true;
        unset($app['exception_handler']);
        // test session
        $app['session.test'] = true;
        
        return $app;
    }
}