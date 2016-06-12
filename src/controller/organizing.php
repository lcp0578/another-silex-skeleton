<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-06-12 PM11:26:39
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
$app->mount('/admin', function ($admin){
    /**
     * @var $admin \Silex\ControllerCollection
     */
    $admin->mount('/blog', function($user){
        /**
         * @var $user \Silex\ControllerCollection
         */
        $user->get('/{user}', function($user){
            return 'Admin blog home page.' . $user;
        });
    });
});