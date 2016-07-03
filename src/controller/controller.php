<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Silex\Application;
use Lcp\BlogControllerProvider;
use Lcp\UserControllerProvider;
use Lcp\PostControllerProvider;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
// use LcpModel\UserConverter;
include 'organizing.php';
// Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use($app)
{
    $name = 'Silex Blog';
    return $app['twig']->render('home/hello.html.twig', array(
        'name' => $name
    ));
})
    ->bind('homepage');
$app->mount('/blog', include 'blog.php');
// other methods
$app->put('/blog/{id}', function ($id)
{
    return new JsonResponse(array(
        'msg' => 'put blog ' . $id
    ));
});
$app->delete('/blog/{id}', function ($id)
{
    return new JsonResponse(array(
        'msg' => 'delete blog ' . $id
    ));
});
$app->patch('/blog/{id}', function ($id)
{
    return new JsonResponse(array(
        'msg' => 'patch blog ' . $id
    ));
});
$app->match('/match', function (Request $request)
{
    $method = $request->getMethod();
    return new JsonResponse(array(
        'msg' => 'match ' . $method
    ));
});
$app->match('/another_match', function ()
{
    return new JsonResponse(array(
        'msg' => 'another match'
    ));
})->method('PATCH');
$app->match('/another_match', function ()
{
    return new JsonResponse(array(
        'msg' => 'another match GET|POST'
    ));
})->method('GET|POST');
// Router Variable Converters
$app->get('/user/{id}', function ($id)
{
    return new JsonResponse(array(
        'id' => $id
    ));
})->convert('id', function ($id)
{
    return $id * 10;
});

$userProvider = function ($user)
{
    return new UserControllerProvider($user);
};
$app->get('/profile/{user}', function (UserControllerProvider $user)
{
    $id = $user->getId();
    return new JsonResponse(array(
        'profile' => $id
    ));
})
    ->convert('user', $userProvider);

// converters callback
$callback = function ($post, Request $request)
{
    return new PostControllerProvider($request->attributes->get('slug'));
};
$app->get('/profile/{id}/{slug}', function (PostControllerProvider $post)
{
    return new JsonResponse($post->getSlug());
})
    ->convert('post', $callback);

// defined as a service
// $app['converter,user'] = function(){
// return new UserConverter();
// };
// $app->get('/info/{user}', function (User $user){
// // ...
// })->converter('user', 'converter.user:converter');
// organizing controller
$blog = $app['controllers_factory'];
$blog->get('/', function ()
{
    return 'blog homepage';
});

$forum = $app['controllers_factory'];
$blog->get('/', function ()
{
    return 'forum homepage';
});

$app->mount('/blog', new BlogControllerProvider());

$app->mount('/blog', $blog);
$app->mount('/forum', $forum);
$app->mount('/lcp_hello', new Lcp\helloControllerProvider());
// Before Router Middleware
$swBefore = function (Request $request, Application $app)
{
    // echo 'before';
    if (true) {
        return new RedirectResponse('/index_dev.php/login');
    }
};

// After Router Middleware
$swAfter = function (Request $reuqest, Response $response, Application $app)
{
    echo 'after';
};

$app->get('/somewhere', function ()
{
    return new JsonResponse([
        'Router Middleware'
    ]);
})
    ->before($swBefore)
    ->after($swAfter);

// Requirements
$app->get('/blog/{postId}/{commentId}', function ($postId, $commentId)
{
    return new JsonResponse([
        'postId' => $postId,
        'commentId' => $commentId
    ]);
})
    ->assert('postId', '\d+')
    ->assert('commentId', '\d+');
// Conditions, need require symfony/expression-language
$app->get('/blog/{id}', function ($id)
{
    return new JsonResponse([
        'User-Agent' => 'chrome',
        'id' => $id
    ]);
})->when("request.headers.get('User-Agent') matches '/chrome/i'");
// Default values
$app->get('/page/{pageName}', function ($pageName)
{
    return new JsonResponse([
        'pageName' => $pageName
    ]);
})->value('pageName', 'index');
// Name Routers
$app->get('/blog_post/{id}', function ($id, Request $request)
{
    $routerName = $request;
    return new JsonResponse($routerName);
})->bind('blog_post_name');

// Controller as Class
$app->get('/foo', 'Lcp\\Foo::bar')->bind('lcp_foo');

$app->get('/global/{id}', function ($id)
{
    return new JsonResponse([
        'id' => $id
    ]);
});
// Redirects
$app->get('/foo_new', function () use($app)
{
    return $app->redirect('/foo');
});
// Forwards
$app->get('/foo_old', function () use($app)
{
    $subRequest = Request::create('/blog_post/2', 'GET');
    // $subRequest = Request::create($app['url_generator']->generate('lcp_foo'), 'GET');
    return $app->handle($subRequest, HttpKernel::SUB_REQUEST);
});
// json
$app->get('/users/{id}', function ($id) use($app)
{
    // return $app->json(['username' => 'lcp0578', 'id' => $id]);
    return $app->json([
        'username' => 'lcp0578',
        'id' => $id
    ], 302);
});
// streaming
$app->get('/images/{file}', function ($file) use($app)
{
    if (! file_exists(__DIR__ . '/../../web/images/' . $file)) {
        return $app->abort(404, 'The image was not found.');
    }
    $stream = function () use($file)
    {
        readfile(__DIR__ . '/../../web/images/' . $file);
    };
    return $app->stream($stream, 200, array(
        'Content-Type' => 'image/png'
    ));
});
$app->get('/baidu', function () use($app)
{
    $stream = function ()
    {
        $fh = fopen('https://www.baidu.com', 'rb');
        while (! feof($fh)) {
                echo fread($fh, 1024);
                ob_flush();
                flush();
            }
            fclose($fh);
        };
        return $app->stream($stream, 200, array('Content-Type' => 'text/html'));
    });
$app->get('/view', function ()
{
    return [
        'a' => 1,
        'b' => 2
    ];
});
// sending a file
//enable the php_fileinfo extension
$app->get('/files/{path}', function($path) use ($app){
    $filePath = dirname(__DIR__).'/files/' . $path;
    if(!file_exists($filePath)){
        $app->abort(404, 'file not found');
    }
    //return $app->sendFile($filePath);
    return $app->sendFile($filePath)
        ->setContent(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'pic.png');
});
// Escaping
$app->get('/name', function(Application $app){
    $name = $app['request']->get('name');
    return "You provided the name {$app->escape($name)}";
});
// Escaping JSON
$app->get('/name.json', function(Application $app){
    $name = $app['request']->get('name');
    return $app->json(array('json' => $name));
});
// disabling CSRF protection on a form
$form = $app['form_factory']->createBulider('form', null, array(
    'csrf_protection' => false
));