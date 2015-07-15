<?php
namespace V1\Controller;

use Think\Controller;

class IndexController extends Controller {
    public function index(){
//         $m = D('Douban','Service');
//         $ret = $m->getBookInfoByIsbn('9787535470652');
//         var_dump($ret);
		/* echo "hello";
		$m = D('Json');
		$ret = $m->select();
		dump($ret); */
    }
    
    /**
     * 获取token值
     *
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月11日 下午7:47:26
     */
    public function getToken(){
        //echo C('TOKEN');
        $this->ajaxReturn(return_data_format(C('TOKEN')));
    }
}