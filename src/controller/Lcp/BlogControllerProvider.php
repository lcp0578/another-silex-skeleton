<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-05-25 12:28:29
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
namespace Lcp;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class BlogControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Application $app) {
            return $app->redirect('/hello');
        });

            return $controllers;
    }
}