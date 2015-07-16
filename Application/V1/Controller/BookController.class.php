<?php
namespace V1\Controller;

use V1\Controller\BaseController;
/**
 *
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月11日 下午5:57:31
 */
class BookController extends BaseController
{

    /**
     * 获取今天的书本信息
     */
    public function today(){
        $map['today'] = date('Y-m-d',time());//获取今天时间
        $listField = 'vol,bookid,today,brief';
        $infoField = 'bookid,title,author,price,pubdate,images,publisher,isbn10,isbn13,catalog,summary,author_intro';
        $this->getItem($map, $listField, $infoField);

    }

    public function week(){
        //标题,书本图片,出版社,期数,出版日期,ISBN作者 7

        $m_booklist = D('Booklist');
        $order = 'id desc';
        $limit = 7;
        $listField = 'today,bookid,id,brief,vol';
        $infoField = 'isbn10,isbn13,title,pubdate,images,publisher,author';
        $data = $m_booklist->distinct(true)->field('id, today')->order($order)->limit($limit)->select();
        //var_dump($data);
        foreach($data as $item){
            $info[] = $this->getItem( array('id'=>$item['id']), $listField, $infoField, true);
        }
        $this->ajaxReturn(return_data_format($info));
    }



    /**
     * 根据条件获取一本书的记录
     * @param array $map
     * @return mixed
     */
    public function getItem($map = array(), $listField = '*', $infoField = '*', $return = FALSE){

        $id = I('get.id') ? I('get.id') : FALSE;
        ! $id || $map['bookid'] = $id;
        $map['status'] = 1;//状态

        $m_booklist = M('Booklist');
        $listdata = $m_booklist->field($listField)->where($map)->find();
        //获取书本基本信息
        if(!$listdata){
            $this->ajaxReturn(C('AJAX_STATUS.ERROR'));
        }
        $m_bookinfo = D('Bookinfo');
        $imap = array(
            'bookid' => $listdata['bookid'],
        );

        $infodata = $m_bookinfo->field($infoField)->where($imap)->find();

        if(!$infodata){
            $this->ajaxReturn(C('AJAX_STATUS.ERROR'));
        }

        if($return){//调用返回

            return array_merge($infodata, $listdata);
        }else{ //请求返回
            $infodata['id'] = $infodata['bookid'];
            unset($infodata['bookid']);
            $ret = json_encode($infodata);
            $data['book'] = json_decode($ret);

            $data['extra'] = array(
                'vol'=>$listdata['vol'],
                'date'=>$listdata['today'],
                'brief'=>$listdata['brief']
            );
            $this->ajaxReturn(return_data_format($data), 'JSON');
        }

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