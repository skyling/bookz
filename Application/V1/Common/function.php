<?php
/**
 * HOME组函数库
 */
/**
 * 签名
 * @param unknown $params
 * @return string
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月11日 下午4:45:53
 */
function sign($params){
    ksort($params);
    $str = '';
    foreach($params as $key=>$value){
        $str .= $key.$value;
    }
    $str .= C('TOKEN');
    return md5($str);
}

/**
 * 正确数据格式返回
 * @param unknown $data
 * @param string $info
 * @param string $status
 * @author frenlee <frenlee@163.com>
 * @since 2015年5月11日 下午6:36:24
 */
function return_data_format($data,$info='',$status=''){
    $ret = C('AJAX_STATUS.SUCCESS');
    $ret['info'] = empty($info) ? $ret['info'] : $info;
    $ret['status'] = empty($info) ? $ret['status'] : $status;

    if(isset($data['extra'])){
        $ret = array_merge($ret, $data);
    }else{
        $ret['data'] = $data;
    }
    if(isset($ret['book'])){
        unset($ret['data']);
    }
    return $ret;
}