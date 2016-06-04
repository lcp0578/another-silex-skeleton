<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Silex\Application;
use Lcp\BlogControllerProvider;
use Lcp\UserControllerProvider;
use Lcp\PostControllerProvider;
// use LcpModel\UserConverter;

// Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use($app)
{
    $name = 'Silex Blog';
    return $app['twig']->render('home/hello.html.twig', array(
        'name' => $name
    ));
})
    ->bind('homepage');
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
$app->get('/foo', 'Lcp\\Foo::bar');

$app->get('/global/{id}', function ($id)
{
    return new JsonResponse([
        'id' => $id
    ]);
});

$app->get('/view', function ()
{
    return [
        'a' => 1,
        'b' => 2
    ];
});
