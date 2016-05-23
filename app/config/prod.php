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