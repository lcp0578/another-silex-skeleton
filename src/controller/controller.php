<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Silex\Application;

// Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use($app)
{
    $name = 'Silex Blog';
    return $app['twig']->render('home/hello.html.twig', array(
        'name' => $name
    ));
})
    ->bind('homepage');
$app->mount('/blog', new Lcp\BlogControllerProvider());

// organizing controller
$blog = $app['controllers_factory'];
$blog->get('/', function (){
    return 'blog homepage';
});

$forum = $app['controllers_factory'];
$blog->get('/', function(){
    return 'forum homepage';
});

$app->mount('/blog', $blog);
$app->mount('/forum', $forum);
//Before Router Middleware
$swBefore = function(Request $request, Application $app){
    //echo 'before';
    if(true){
        return new RedirectResponse('/index_dev.php/login');
    }
};

//After Router Middleware
$swAfter = function(Request $reuqest, Response $response, Application $app){
    echo 'after';
};

$app->get('/somewhere', function(){
    return new JsonResponse(['Router Middleware']);
})
->before($swBefore)
->after($swAfter);

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