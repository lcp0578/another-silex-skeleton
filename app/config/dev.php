<?php
/**
 * development configuration
 */

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// [debug]
$app['debug'] = true;

$app->register(new MonologServiceProvider());
$app->register(new WebProfilerServiceProvider());

// [profiler]
$app['profiler.cache_dir'] = __DIR__ . '/../../var/cache/profiler';
$app['profiler.mount_prefix'] = '/_profiler';

// [monolog]
$app['monolog.logfile'] = __DIR__.'/../../var/logs/silexblog_dev.log';
