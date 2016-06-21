<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-06-21 11:29:03
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
namespace Lcp;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

class helloControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // create a new controller based on the default route
        $controllers = $app['controllers_factory'];
        
        $controllers->get('/', function (Application $app){
            return $app->redirect('/hello');
        });
        return $controllers;
    }
}