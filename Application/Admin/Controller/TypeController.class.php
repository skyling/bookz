<?php
namespace Admin\Controller;
/**
 * 分类管理
 * @author fren<frenlee@163.com>
 * @since 2015年5月13日
 */
class TypeController extends BaseController
{
    /**
     * 首页
     * @param number $p
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月14日 下午1:24:54
     */
    function index($p=0){
        $m = D('Type');
        if(IS_POST){//添加
            $data = $m->create();
            if($data){
                $m->add();
                $this->ajaxReturn(ajax_return_data());
            }else{
                $this->ajaxReturn(ajax_return_data(1, $m->getError()));
            }
        }
        //显示
        $limit = page_limit($p);
        $data = $m->limit($limit)->select();
        $this->assign('info', $data);
        $this->display();
    }
    
    
    function alert($id='0'){
        $m = D('Type');
        if(IS_POST){
            $data = $m->create();
            if($data){
                $m->save($data);
                $this->ajaxReturn(ajax_return_data(0));
            }else{
                $this->ajaxReturn(ajax_return_data(1));
            }         
        }
        $data = $m->find($id);
        $this->assign('info', $data);
        $this->display();
    }
}

?>