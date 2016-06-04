<?php
use Symfony\Component\HttpFoundation\Response;

/**
 * @var $app \Silex\Application
 */
$app->error(function(\Exception $e, $code){
    return new Response('msg:' . $e->getMessage() . '; code=' .$e->getCode());
});