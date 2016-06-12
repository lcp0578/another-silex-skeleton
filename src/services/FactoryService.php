<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-06-13 AM12:06:32
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
$app['lcp_service'] = $app->factory(function(){
    return new Service();
});