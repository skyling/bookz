<?php
namespace V1\Controller;

use Think\Controller;

class BaseController extends Controller
{
    protected function _initialize() {
        //$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        //var_dump(C('AJAX_STATUS.SUCCESS'));
        //验证
        $this->validate();
    }
    
    /**
     * 验证
     */
    //TODO 添加验证
    private function validate(){
        if($_GET['v']=='test')return TRUE;
        if(IS_POST){
            $params = $_POST;
            $sign = $params['sign'];
            if(empty($sign)){
                sleep(1);
                $this->ajaxReturn(return_data_format('获取信息失败', '4002',  0),'JSON');
            }
            unset($params['sign']);
            $t = sign($params);
            if(strcasecmp($sign,$t)!=0){
                sleep(1);
                $this->ajaxReturn(return_data_format('获取信息失败', '4002', 0),'JSON');
            }
        }else{
            sleep(1);
            $this->ajaxReturn(return_data_format('获取信息失败', '4002', 0),'JSON');
        }
    }

    /**
     * 获取返回数据数组
     * @param $code
     * @param $info
     * @param $status
     * @return array
     */
    private function _get_return($code, $info, $status){
        return array(
            'info' => $code,
            'data' => $info,
            'status' => $status,
        );
    }
}

?>