<?php
/**
  * filename
  *
  * @package: packname
  * @author: lcp0578@gmail.com
  * @date: 2016年6月1日 下午10:56:02
  * @version: 0.0.1
  * @copyright: http://lcpeng.cn
  */
namespace Lcp;


class PostControllerProvider
{
    private $slug;
    
    public function __construct($slug)
    {
        $this->slug = $slug;
    }
    
    public function getSlug()
    {
        return 'slug:' . $this->slug;
    }
}