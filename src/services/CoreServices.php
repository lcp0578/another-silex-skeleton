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
/**
 * @var $requestStack  \Symfony\Component\HttpFoundation\RequestStack
 */
$requestStack = $app['request_stack'];
$id = $requestStack->getCurrentRequest()->get('id');

/**
 * @var $routes \Symfony\Component\Routing\RouteCollection
*/
$routes = $app['routes'];
$routes->setCondition($condition);

/**
 * @var $urlGenerator \Symfony\Component\Routing\Generator\UrlGenerator
 */
$urlGenerator = $app['url_generator'];
$homepage = $urlGenerator->generate('homepage');

/**
 * @var $controllers \Silex\ControllerCollection
 */
$controllers->flush();

/**
 * @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcher
 */
$dispatcher = $app['dispatcher'];
$dispatcher->addListener($eventName, $listener);

/**
 * @var $resolver \Symfony\Component\HttpKernel\Controller\ControllerResolver
 */ 
$resolver = $app['resolver'];
$resolver->getArguments($request, $controller);

/**
 * @var $kernel \Symfony\Component\HttpKernel\HttpKernel
 */
$kernel = $app['kernel'];
$kernel->handle($request);

/**
 * @var $requestContent \Symfony\Component\Routing\RequestContext
 */
$requestContent = $app['request_content'];
$requestContent->fromRequest($request);

/**
 * @var $exceptionHandler \Silex\ExceptionHandler
 */
$exceptionHandler = $app['exception_handler'];
$exceptionHandler->onSilexError($event);

/**
 * @var $logger \Psr\Log\LoggerInterface
 */
$logger = $app['logger'];
$logger->debug($message);