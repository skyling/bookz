<?php
/**
 * 字符串转化为数组
 * @param unknown $str
 * @param string $delimiter
 * @return array
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月11日 下午4:46:10
 */
function str2arr($str, $delimiter=','){
    return explode($delimiter, $str);
}

/**
 * 数组转化为字符串
 * @param unknown $arr
 * @param string $glue
 * @return string
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月11日 下午4:46:03
 */
function arr2str($arr , $glue=','){
    return implode($glue, $arr);
}

/**
 * 检测验证码
 * @param $code 验证码
 * @param number $id
 * @return \Think\bool
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月11日 下午11:46:20
 */
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
/**
 * 数据签名认证
 *
 * @param array $data	被认证的数据
 * @return string 签名
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function data_auth_sign($data) {
    // 数据类型检测
    if (! is_array ( $data )) {
        $data = ( array ) $data;
    }
    ksort ( $data ); // 排序
    $code = http_build_query ( $data ); // url编码并生成query字符串
    $sign = sha1 ( $code ); // 生成签名
    return $sign;
}

/**
 * 用户md5加密
 * @param string $str 字符串
 * @param string $key 密钥
 * @return Ambigous <string, string> 加密字符串
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月12日 下午12:14:54
 */
function think_ucenter_md5($str, $key = 'ThinkUCenter'){
    return '' === $str ? '' : md5(sha1($str) . $key);
}

/**
 * 系统加密
 * @param unknown $data
 * @param unknown $key
 * @param number $expire
 * @return mixed
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月12日 下午9:44:02
 */
function think_ucenter_encrypt($data, $key, $expire = 0){
    $key = md5($key);
    $data = base64_encode($data);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';
    for($i=0; $i < $len; $i++){
        if($x == $l) $x=0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    $str = sprintf('%010d', $expire ? $expire + time() : 0);
    for($i = 0; $i < $len; $i++){
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
    }
    return str_replace('=', '', base64_encode($str));
}

/**
 * 系统解密
 * @param unknown $data
 * @param unknown $key
 * @return string
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月12日 下午9:45:49
 */
function think_ucenter_decrypt($data, $key){
    $key    = md5($key);
    $x      = 0;
    $data   = base64_decode($data);
    $expire = substr($data, 0, 10);
    $data   = substr($data, 10);
    if($expire > 0 && $expire < time()) {
        return '';
    }
    $len  = strlen($data);
    $l    = strlen($key);
    $char = $str = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char  .= substr($key, $x, 1);
        $x++;
    }
    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }else{
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}

?>