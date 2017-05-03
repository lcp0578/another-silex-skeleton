<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016 -06-20 11:56:28
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
namespace Lcp;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Api\EventListenerProviderInterface;
use Silex\Application;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class LcpHelloServiceProvider implements ServiceProviderInterface, BootableProviderInterface, EventListenerProviderInterface
{
    public function register(Container $app)
    {
        $app['hello'] = $app->protect(function($name) use ($app){
            $default = $app['hello.default_name'] ? $app['hello.default_name'] : '';
            $name = $name ? : $default;
            return 'Hello ' . $app->escape($name);
        });
    }
    
    public function boot(Application $app)
    {
        // do something
    }
    
    public function subscribe(Container $app, EventDispatcherInterface $dispatcher)
    {
        $dispatcher->addListener(KernelEvents::REQUEST, function(FilterResponseEvent $event) use ($app){
            // do something 
        });
    }
}