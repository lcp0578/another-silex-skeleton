<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Silex\Provider\SerializerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TranslationServiceProvider;
// use KPhoen\Provider\NegotiationServiceProvider;
// use Lcp\BlogControllerProvider;

/**
 * @var $app \Silex\Application
 */
$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new SerializerServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new TranslationServiceProvider());
$app->extend('translator.resources', function ($resource, $app){
    $resource = array_merge($resource, array(
        array()
    ));
    return $resource;
});
// $app->register(new NegotiationServiceProvider(array(
//     'gpx' => array('application/gpx+xml'),
//     'kml' => array('application/vnd.google-earth.kml+xml', 'application/vnd.google-earth.kmz'),
// )));
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});
// Doctrine DBAL
$app->register(new Silex\Provider\DoctrineServiceProvider());
// $app->register(new BlogControllerProvider());

// Before Application Middleware
$app->before(function(Request $request, Application $app){

});
// Before Application Middleware(early), Application::EARLY_EVENT = 512
$app->before(function(Request $request, Application $app){

}, Application::EARLY_EVENT);
// Middleware Priority, Application::LATE_EVENT = -512
$app->before(function(Request $request, Application $app){

}, Application::LATE_EVENT);
// Middleware Priority, number
$app->before(function(Request $request, Application $app){

}, 32);
// After Application Middleware
$app->after(function(Request $request, Response $response){

});
// Finish Application Middleware
$app->finish(function(Request $request, Response $reponse){

});
//  Short-circuiting the Controller
$app->before(function(Request $request){
    if(strpos($request->getBaseUrl(), 'profile') !== false){
        return new RedirectResponse('/login');
    }
});

// $app->view(function(array $controllerResult, Request $request) use ($app) {
//     return $app->json($controllerResult);
// });
$app->view(function(array $controllerResult, Request $request) use ($app){
//     $acceptHeader = $request->headers->get('Accept');
//     $bestFormat = $app['negotiator']->getBestFormat($acceptHeader, array('json', 'xml'));
    
//     if('json' === $bestFormat){
//         return new JsonResponse($controllerResult);
//     }
    
//     if('xml' === $bestFormat){
//         return $app['serializer.xml']->renderResponse($controllerResult);
//     }
    return $controllerResult;
});
return $app;