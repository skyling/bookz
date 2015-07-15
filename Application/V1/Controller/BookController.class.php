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
        $m_booklist = M('Booklist');
        $field = 'brief,vol,bookid,today';
        $listdata = $m_booklist->field($field)->where($map)->find();//获取书本基本信息
        if(!$listdata){
            $this->ajaxReturn(C('AJAX_STATUS.ERROR'));
        }

        $m_bookinfo = D('Bookinfo');
        $imap = array(
            'status' => 1,
            'bookid' => $listdata['bookid'],
        );
        $field = 'bookid,title,author,price,pubdate,images,publisher,isbn10,isbn13,catalog,summary,author_intro';
        $infodata = $m_bookinfo->field($field)->where($imap)->find();

        if(!$infodata){
            $this->ajaxReturn(C('AJAX_STATUS.ERROR'));
        }
        $infodata['id'] = $infodata['bookid'];
        unset($infodata['bookid']);
        $ret = json_encode( $infodata);
        $data['book'] = json_decode($ret);
        $data['extra'] = array('vol'=>$listdata['vol'],'date'=>$listdata['today'],'brief'=>$listdata['brief']);
        $this->ajaxReturn(return_data_format($data), 'JSON');
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