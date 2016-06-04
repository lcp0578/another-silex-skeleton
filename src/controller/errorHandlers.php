<?php
use Symfony\Component\HttpFoundation\Response;

/**
 * @var $app \Silex\Application
 */
$app->error(function(\Exception $e, $code){
    return new Response($e->getMessage() . $e->getCode());
});