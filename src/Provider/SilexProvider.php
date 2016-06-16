<?php

/**
 * All of these are within the Silex\Provider namespace
 * 
 * Conventions:
 * 1.Overriding existing services must occur after the provider is registered.
 *   Reason: If the service already exists, the provider will overwrite it.
 * 2.You can set parameters any time after the provider is registered, but before the service is accessed.
 *   Reason: Providers can set default values for parameters. Just like with services, the provider will overwrite existing values.
 *   
 */
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\RememberMeServiceProvider;
use Silex\Provider\SecurityServiceProvider;

$app = new Silex\Application();
$app->register(new DoctrineServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new HttpCacheServiceProvider());
$app->register(new MonologServiceProvider());
$app->register(new RememberMeServiceProvider());
$app->register(new SecurityServiceProvider());