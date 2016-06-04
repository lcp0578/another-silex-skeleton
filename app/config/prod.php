<?php
/**
 * configure your app for the production environment
 * 
 */
// [twig]
$app['twig.path'] = [
    __DIR__ . '/../../src/views'
];
$app['twig.options'] = [
    'cache' => __DIR__ . '/../../var/cache/twig'
];
//[assets]
$app['assets.version'] = 'v0.0.1';
$app['assets.version_format'] = '%s?version=%s';
$app['assets.named_packages'] = [
    'css' => [
        'version' => 'css2',
        'base_path' => '/whatever-makes-sense'
    ],
    'images' => [
        'base_urls' => [
            'https://img.example.com'
        ]
    ]
];
//[Doctrine DBAL]
/**
// $app['db.options'] = [
//     'driver' => 'pdo_mysql',
//     'dbname' => 'silex_demo',
//     'host' => 'localhost',
//     'port' => 3306,
//     'user' => 'root',
//     'password' => 'lcp0578',
//     'charset' => 'utf8mb4',
// ];
**/

//[Doctrine DBAL multiple databases]
$app['dbs.options'] = [
    'mysql_read' => [
        'driver' => 'pdo_mysql',
        'dbname' => 'silex_demo',
        'host' => 'localhost',
        'port' => 3306,
        'user' => 'root',
        'password' => 'lcp0578',
        'charset' => 'utf8mb4',
    ],
    'mysql_write' =>[
        'driver' => 'pdo_mysql',
        'dbname' => 'silex_demo',
        'host' => 'localhost',
        'port' => 3306,
        'user' => 'root',
        'password' => 'lcp0578',
        'charset' => 'utf8mb4',
    ]
];

//[Global Configuration for controllers]
/**
 * If a controller setting must be applied to all controllers 
 * (a converter, a middleware, a requirement, or adefault value)
 */
$app['controllers'] 
->value('id', 1)
->assert('id', '\d+')
//->requireHttps()
->method('GET')
->convert('id', function ($id){
    return $id * 10;
})
->before(function(){});