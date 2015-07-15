<?php
namespace Admin\Controller;

/**
 * 读书笔记
 * @author fren<frenlee@163.com>
 * @since 2015年5月16日
 */
class AnnotationsController extends BaseController
{
    function index(){
        $m = D('Booklist');
        $data = $m->select();
        $this->assign('info', $data);
        $this->display();
    }
    
    
    function showList($id='',$p='0'){
        if(empty($id))return false;
        $b = M('booklist');
        $book = $b->field('isbn,title,today')->find($id);
        $this->assign('book', $book);
        $map = array(
            'bookid'=>$id,
        );
        $m = D('Annotations');
        $limit = page_limit($p);
        $data = $m->where($map)->limit($limit)->select();
        $this->assign('info', $data);
        $this->display();
    }
    
    function showItem($id=''){
        $this->display();
    }
    
    /**
     * 从豆瓣获取读书笔记并添加至数据库
     * 
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月17日 下午2:02:20
     */
    function add(){
        $j = D('Json');
        $m = D('Annotations');
        $p = 0;
        $bookid = 9;
        $ret = $j->getAnnotations('1084336',$p);
        var_dump($ret);
        foreach ($ret->annotations as $val){
            var_dump($val);
            $r = $m->addData($bookid, $val);
        }
        //$m->addData($bookid, $ret->annotations[0]);
        //dump($ret->annotations[0]);
        echo "ok";
        exit;
        $annotations = array();
        while(($ret = $j->getAnnotations('1084336',$p))!=null){
            $annotations[] = $ret;
            $p++;
        }
        foreach ($annotations as $val){
            foreach ($val->annotations as $val){
                $m->addData($bookid, $val->book);
            }    
        }
        echo "----->$p<hr>";
        exit;
        echo(json_encode($ret));
        $this->display();
    }
}

?>