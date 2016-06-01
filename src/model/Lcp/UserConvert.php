<?php
/**
  * filename
  *
  * @package: LcpModel/UserConverter
  * @author: lcp0578@gmail.com
  * @date: 2016-06-01 PM11:21:20
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
namespace LcpModel;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Persistence\ObjectManager;

class UserConverter
{
    private $om;
    
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }
    
    public function converter($id)
    {
        if(null === $user = $this->om->find('User', intval($id)))
        {
            throw new NotFoundHttpException(sprintf('User %d does nto exist', $id));
        }
        return $user;
    }
}