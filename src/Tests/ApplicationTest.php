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
    public function testIntialPage()
    {
        $client = $this->createClient();
        $crawer = $client->request('GET', '/');
        
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawer->filter('h1:contains("Contact us")'));
        $this->asserCount(1, $crawer->filter('form'));
    }
}