<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-06-14 AM12:20:12
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
use Silex\Application;

use Silex\Application\FormTrait;
use Silex\Application\MonologTrait;
use Silex\Application\SecurityTrait;
use Silex\Application\SwiftmailerTrait;
use Silex\Application\TranslationTrait;
use Silex\Application\TwigTrait;
use Silex\Application\UrlGeneratorTrait;

class MyApplication extends Application
{
    use FormTrait;
    use MonologTrait;
    use SecurityTrait;
    use SwiftmailerTrait;
    use TranslationTrait;
    use TwigTrait;
    use UrlGeneratorTrait;
    
    public function __construct()
    {
        parent::__construct();
    }
}

$myApp = new MyApplication();

// FormTrait
$myApp->form();
$myApp->namedForm($name);

// MonologTrait
$myApp->log($message);

// SecurityTrait
$myApp->encodePassword($user, $password);
$myApp->isGranted($attributes);

// SwiftmailerTrait
$myApp->mail($message);

// TranslationTrait
$myApp->trans($id);
$myApp->transChoice($id, $number);

// TwigTrait
$myApp->render($view);
$myApp->renderView($view);

// UrlGeneratorTrait
$myApp->url($route);
$myApp->path($route);
