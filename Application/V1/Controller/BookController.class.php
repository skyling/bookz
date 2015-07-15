<?php
namespace V1\Controller;

use V1\Controller\BaseController;

class BookController extends BaseController
{
    /**
     * 获取今天的书本信息
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月11日 下午5:57:31
     */
    public function today(){
        $map = array(
            'today' => date('Y-m-d',time()),//获取今天时间
            'status' => 1,//状态
        );
        $m = M('Booklist');
        $listdata = $m->where($map)->find();//获取书本基本信息
        if(!$listdata){
            $this->ajaxReturn(C('AJAX_STATUS.ERROR'));
        }
        $i = M('Bookinfo');
        $imap = array(
            'status' => 1,
            'bookid' => $listdata['bookid'],
        );

        $infodata = $i->where($imap)->find();

        if(!$infodata){
            $this->ajaxReturn(C('AJAX_STATUS.ERROR'));
        }
        $data['data'] = json_decode($infodata['json']);
        $data['extra'] = array('vol'=>$infodata['vol'],'date'=>$listdata['today'],'brief'=>$infodata['brief']);
        $this->ajaxReturn(return_data_format($data));
    }
    
    /**
     * 获取书本信息
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月11日 下午5:54:35
     */
    public function bookinfo(){
        $m = D('Json');
        $data = $_SERVER;
    }
    
    /**
     * 获取读书笔记
     * 
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月11日 下午5:54:29
     */
    public function annotations(){
        $id = isset($_POST['id']) ? I('post.id') : '';
        $p = isset($_POST['p']) ? I('post.p') : 0;
        if(empty($id) ){
            $this->ajaxReturn(return_error_data_format());
        }
        $j = D('Json');
        $data = $j->getAnnotations($id,$p);
        $data['data'] = json_decode($data['data'],true);
        $this->ajaxReturn(return_data_format($data));
    }
}

?>