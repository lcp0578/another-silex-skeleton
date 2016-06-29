<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-06-29 11:34:38
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
namespace LcpApp;

use Silex\WebTestCase;
class AppTest extends WebTestCase
{
    public function createApplication()
    {
        return require __DIR__.'../../../app/app.php';
    }
    public function testFooBar()
    {
        
    }
}