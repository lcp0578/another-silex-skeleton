<?php

/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-06-29 11:56:42
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
use Symfony\Component\HttpFoundation\Request;
$app->before(function(Request $request){
    if(0 === strpos($request->headers->get('Content-Type'), 'application/json')){
        
    }
});