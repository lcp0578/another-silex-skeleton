<?php
/**
  * filename
  *
  * @package: Provider/ThirdPartyProvider
  * @author: lcp0578@gmail.com
  * @date: 2016-06-20 11:11:58
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
//**************************************************************************************
//* Third Party ServiceProviders for Silex 2.x
//* https://github.com/silexphp/Silex/wiki/Third-Party-ServiceProviders-for-Silex-2.x
//***************************************************************************************
use Silex\Application;
// https://github.com/nrk/PredisServiceProvider
$app = new Application();
$app->register(new Predis\Silex\ClientServiceProvider(), [
    'predis.parameters' => 'tcp://127.0.0.1:6379',
    'predis.options'    => [
        'prefix'  => 'silex:',
        'profile' => '3.0',
    ],
]);
$app->register(new Predis\Silex\ClientsServiceProvider(), [
    'predis.clients' => [
        'client1' => 'tcp://127.0.0.1:6379',
        'client2' => [
            'host' => '127.0.0.1',
            'port' => 6380,
        ],
        'client3' => [
            'parameters' => 'tcp://127.0.0.1:6381',
            'options' => [
                'profile' => 'dev',
                'prefix'  => 'silex:',
            ],
        ],
    ],
]);