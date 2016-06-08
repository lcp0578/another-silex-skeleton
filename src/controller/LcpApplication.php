<?php
/**
  * filename
  *
  * @package: controller
  * @author: lcp0578@gmail.com
  * @date: 2016-6-8  PM 11:50:31
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
use Silex\Application;

class LcpApplication extends Application
{
    use Application\TwigTrait;
    use Application\SecurityTrait;
}