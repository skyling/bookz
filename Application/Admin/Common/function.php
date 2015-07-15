<?php
define('AUTH_KEY', '5&>=,y"YOoa_qPXiZ:9/!TR4)zk18W*DV2h7s<f6');//定义加密密钥
/**
 * 是否登录
 * @return number|Ambigous <number, mixed>
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月11日 下午11:49:17
 */
function admin_is_login() {
    $user = think_ucenter_decrypt(session ( 'admin_auth' ), AUTH_KEY);
    if (empty ( $user )) {
        return 0;
    } else {
        $admin_auth = think_ucenter_encrypt($user, AUTH_KEY, C('AUTH_TIME'));
        session('admin_auth', $admin_auth);
        return  true;
    }
}

function alert_debug($str){
    echo "<script>alert('$str');</script>";
}
/**
 * 获取登录用户名
 * @return Ambigous <string, \Think\mixed>
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月13日 上午10:45:36
 */
function get_admin_name(){
    $uid = get_admin_uid();
    $ret = M('Admin')->field('username')->find($uid);
    return $ret ? $ret['username'] : ''; 
}
/**
 * 获取管理员ID
 * @return string
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月13日 上午10:45:50
 */
function get_admin_uid(){
    return think_ucenter_decrypt(session('admin_auth'), AUTH_KEY);
}

/**
 * 分页条件
 * @param unknown $p
 * @return string
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月13日 下午12:59:44
 */
function page_limit($p){
    $count = C('PAGE_COUNT');
    $str = $p*C('PAGE_COUNT').','.$count;
    return $str;
}

/**
 * ajax请求返回数据
 * @param number $type 0 成功，1失败
 * @return Ambigous <multitype:string >
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月14日 下午12:27:14
 */
function ajax_return_data($type=0, $str=''){
    $data = array(
        array(
            'status' => 'y',
            'info' => '操作成功',
        ),
        array(
            'status' => 'n',
            'info' => '操作失败'
        ),
    );
    if(!empty($str)){
        $data[$type]['info'] = $str;
    }
    return $data[$type];
}

/**
 * 获取书本分类列表
 * @param string $field
 * @return \Think\mixed
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月14日 下午1:13:15
 */
function get_type_list($field=''){
    $m = D('Type');
    $map = array(
        'status' => 1,
    );
    $field = $field ? $field :'id,title';
    $order = 'sort asc';
    $data = $m->field($field)->order($order)->where($map)->select();
    return $data;
}

/**
 * 根据id获取字段
 * @param string $model
 * @param string $id
 * @param string $filed
 * @return string|Ambigous <unknown, \Think\mixed>
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月15日 下午9:53:38
 */
function get_field_by_id($model='', $id='', $filed='title'){
    if(empty($model) || empty($filed) || empty($id)){
        return '';
    }
    $ret = M($model)->field($filed)->find($id);
    return count($ret)==1 ? $ret[$filed] : $ret;
}

/**
 * 获取最大期数
 * @return int
 */
function get_max_vol(){
    return intval(M('Booklist')->max('vol'))+1;
}