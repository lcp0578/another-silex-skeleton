<?php
/**
  * filename
  *
  * @package: Lcp\UserProvider
  * @author: lcp0578@gmail.com
  * @date: 2016年5月30日 下午11:05:44
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
namespace Lcp;


class UserControllerProvider 
{
   private $id;
   
   public function __construct($id)
   {
       $this->id = $id;
   }
   
   public function getId()
   {
       return $this->id;
   }
  
} 