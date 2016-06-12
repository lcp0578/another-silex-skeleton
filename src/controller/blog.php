<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-6-12 PM11:40:21
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
/**
 * @var $blog \Silex\ControllerCollection
 */
$blog = $app['controllers_factory'];
$blog->get('/home', function(){
    return 'blog home page';
});
return $blog;