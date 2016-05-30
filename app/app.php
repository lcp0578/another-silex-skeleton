<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
// use Lcp\BlogControllerProvider;

/**
 * @var $app \Silex\Application
 */
$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});

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
return $app;