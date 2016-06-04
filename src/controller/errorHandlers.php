<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
$app->error(function (\Exception $e, $code) use ($app)
{
    if($app['debug'] == true){
        return ;
    }
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
$app->error(function (\Exception $e, $code) use ($app)
{
    if($app['debug'] == true){
        return ;
    }
    return new Response('Error', 404, [
        'X-Status-Code' => 200
    ]);
}, 3);

$app->error(function (\Exception $e, Request $request, $code) use($app)
{
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/' . $code . '.html.twig',
        'errors/' . substr($code, 0, 2) . 'x.html.twig',
        'errors/' . substr($code, 0, 1) . 'xx.html.twig',
        'errors/default.html.twig'
    );

    return new Response($app['twig']->resolveTemplate($templates)
        ->render(array(
        'code' => $code
    )), $code);
});