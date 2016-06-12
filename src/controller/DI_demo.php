<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016-06-12 PM11:49:41
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
class JsonUserPersister
{
    private $basePath;
    
    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }
    
    public function persister(User $user)
    {
        $data = $user->getAttributes();
        $json = json_encode($data);
        $filename = $this->basePath . '/' . $user->id . '.json';
        file_put_contents($filename, $json, LOCK_EX);
    }
}