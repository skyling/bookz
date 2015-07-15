<?php
namespace Admin\Model;

use Think\Model;
/**
 * 后台管理员
 * @author fren<frenlee@163.com>
 * @since 2015年5月12日
 */

class AdminModel extends Model
{
    /* 用户模型自动验证 */
    protected $_validate = array(
        array('username', '1,30', -1, self::EXISTS_VALIDATE, 'length'), //用户名长度不合法
        array('password', '6,30', -4, self::EXISTS_VALIDATE, 'length'), //密码长度不合法
    );
    
    /* 用户模型自动完成 */
    protected $_auto = array(
        array('password', 'think_ucenter_md5', self::MODEL_BOTH, 'function', AUTH_KEY),
        array('reg_time', NOW_TIME, self::MODEL_INSERT),
        array('reg_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
    );
    
    /**
     * 用户登录
     * @param unknown $username
     * @param unknown $password
     * @return boolean
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月12日 下午10:06:32
     */
    public function login($username, $password){
        $map = array(
            'username'=>$username,
            'password'=>think_ucenter_md5($password,AUTH_KEY),
            'status'=>1,
        );
        $ret = $this->where($map)->field('id')->find();
        if($ret){
            session('admin_auth', think_ucenter_encrypt($ret['id'],AUTH_KEY, C('AUTH_TIME')));
            $this->update_login($ret['id']);//更新数据
            return true;
        }
        return false;
    }
    
    /**
     * 用户注销
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月12日 下午10:06:44
     */
    public function logout(){
        session('admin_auth','');
    }
    
    /**
     * 添加管理员
     * @param string $username
     * @param string $password
     * @return boolean|\Think\mixed
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月13日 上午10:35:20
     */
    public function addUser($username='', $password=''){
        if(empty($username) || empty($password))return false;
        $data = $this->create();
        $data['username'] = $username;
        $data['password'] = think_ucenter_md5($username,AUTH_KEY);
        return  $this->add($data);
    }
    
    /**
     * 登录成功后更新用户信息
     * @param unknown $uid
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月13日 上午10:35:15
     */
    function update_login($uid){
        $data['last_login_ip'] = ip2long(get_client_ip());
        $data['last_login_time'] = time();
        $this->where("id=$uid")->setInc('login');
        $this->where("id=$uid")->save($data);
    }
    
    
    
}

?>