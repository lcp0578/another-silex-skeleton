<?php
/**
 * @package     Lcp\Foo
 * @author      lichunpeng
 * @date        2016-06-04 11:15
 * @copyright   lcpeng.cn
 */
namespace Lcp;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;

class Foo
{

    public function bar(Request $request, Application $app)
    {
        return new JsonResponse([
            'class' => 'foo',
            'method' => 'bar'
        ]);
    }
}