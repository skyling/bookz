<?php
namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller
{
    function _initialize(){
        if(!admin_is_login()){
            $this->redirect('Public/login');
        }
    }
    
    /**
     * 删除
     * @param unknown $model
     * @param string $id
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月15日 上午11:57:19
     */
    function delete($model=CONTROLLER_NAME, $id=''){
        $m = M($model);
        if(empty($id) || empty($model) || !$m->delete($id)){
            $this->ajaxReturn(ajax_return_data(1,'删除失败，请稍后重试！'));
        }
        $this->ajaxReturn(ajax_return_data(0,'删除成功！'.$data));
    }
    
    /**
     * 改变状态
     * @param string $model
     * @param string $id
     * @param string $status
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月15日 下午10:01:12
     */
    function setStatus($model=CONTROLLER_NAME, $id='', $status=''){
        $m = M($model);
        if(empty($id) || empty($model) || $status === '' ||!$m->where("id=$id")->setField('status', $status)){
            $this->ajaxReturn(ajax_return_data(1,$model.$id.$status));
        }
        $this->ajaxReturn(ajax_return_data());
    }
  
}

?>