<?php
namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller
{
    /**
     * 后台用户登录
     */
    public function login($username = null, $password = null, $verify = null){
        if(IS_POST){
            if(!check_verify($verify)){
                $this->error('验证码输入错误！');
            }
            $m = D('Admin');
            if($m->login($username, $password)){
                //跳转至首页
                $this->success('登录成功！', U('Index/index'));
            }else{
                $this->error('登录信息错误！',U('login'));
            }
        }
        if(admin_is_login()){
            $this->redirect('Index/index');
        }else{
            $this->display();
        }
    }

    /* 退出登录 */
    public function logout(){
        if(admin_is_login()){
            D('Admin')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            //$this->redirect('login');
        }
    }
    
    /**
     * 生成验证码
     * 
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月12日 上午10:50:11
     */
    function verify(){
        $config =  array(    
            'fontSize'    =>    18,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数    
            'imageW'    =>  120,
            'imageH'=>40,
         );
        $verify = new \Think\Verify($config);
        $verify->entry(1);
    }
}

?>