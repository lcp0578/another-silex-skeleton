<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-06-13 AM12:08:55
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
$app['lcp_service'] = function(){
    return new Service();
};
// access container from closure
$app['some_service'] = function(){
    return new Service($app['some_other_service'], $app['some_service.config']);
};

$app['user.persist_path'] = '/temp/users';
$app['user.persister'] = function($app){
    return new JsonUserPersister($app['user.persist_path']);
};
// Protected closures
/**
 * @var $app \Silex\Application
 */
$app['closure_parameter'] = $app->protect(function($a, $b){
    return $a + $b;
});

echo $add(2, 3);