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
use Symfony\Component\HttpFoundation\ParameterBag;

$app->before(function(Request $request){
    if(0 === strpos($request->headers->get('Content-Type'), 'application/json')){
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app->post('/blog/posts', function(Request $request) use ($app){
    $post = array(
        'title' => $request->request->get('title'),
        'body' => $request->request->get('body')
    );
    
    $post['id'] = createPost($data);
    return $app->json($data, 201);
});