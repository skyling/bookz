<?php
/**
 *
 * Author: fren <frenlee@163.com>
 * Sence: 2015/7/12 22:02
 */

namespace Common\Model;

use Think\Model;
/**
 * Class DBJsonModel
 * @package Common\Model
 * 豆瓣数据模型
 */
class DbjsonModel extends Model{

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
    );

    /**
     * 添加数据
     * @param $type
     * @param $url
     * @param $data
     * @return bool|mixed
     */
    public function setJson($type, $url, $info){
        if(empty($type) || empty($url) || empty($info)) return FALSE;
        $data = array(
            'type' => $type,
            'url' => $url,
            'data' => $info,
        );
        $data = $this->create($data);
        return $this->add($data);
    }

    /**
     * 获取数据
     * @param $url 请求url
     */
    public function getJson($url = ''){
        if(empty($url)) return FALSE;
        $data = $this->field('data')->where(array("url"=>$url))->find();
        return $data['data'];
    }




}