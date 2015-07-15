<?php
namespace Admin\Controller;

/**
 * 入口
 * @author fren<frenlee@163.com>
 * @since 2015年5月11日
 */
class IndexController extends BaseController {
    
    /**
     * 首页
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月12日 下午11:04:55
     */
    public function index(){
        $this->display();
    }
    
    public function welcome(){
        $this->meta_title ="welcome";
        $this->display();
    }
}