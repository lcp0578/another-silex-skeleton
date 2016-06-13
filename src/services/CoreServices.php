<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-06-13 PM11:56:11
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
// Core services
$requestStack = $app['request_stack'];
/**
 * @var $requestStack  \Symfony\Component\HttpFoundation\RequestStack
*/
$id = $requestStack->getCurrentRequest()->get('id');
/**
 * @var $routes \Symfony\Component\Routing\RouteCollection
*/
$routes = $app['routes'];
$routes->setCondition($condition);