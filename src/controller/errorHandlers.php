<?php
use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @var $app \Silex\Application
 */
$app->error(function (\Exception $e, $code) use ($app)
{
    if($app['debug'] == true){
        return ;
    }
    return new Response('msg:' . $e->getMessage() . '; code=' . $e->getCode());
}, 4);
$app->error(function (\Exception $e, $code)
{
    switch ($code) {
        case '404':
            $msg = 'Not Found';
            break;
        default:
            $msg = 'something wrong';
            break;
    }
    return new Response($msg);
}, 2);
/*
 * The higher this value, the earlier an even listener will be triggered in the chain (defaults to -8)
 */
$app->error(function (\Exception $e, $code)
{
    return new Response('Error', 404, [
        'X-Status-Code' => 200
    ]);
}, 3);