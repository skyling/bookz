<?php
namespace Common\Model;

use Think\Model;
class JsonModel extends Model
{
    protected $_auto = array(
        array('create_time','time', Model::MODEL_INSERT,'function'),
        array('update_time','time', Model::MODEL_BOTH,'function'),
    );

    /**
     * 获取书本信息
     * @param string $isbn
     * @return json json数据
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月16日 上午11:47:51
     */
    function getBookinfo($isbn=''){
        $s = D('Douban', 'Service');
        $data = $s->getBookInfoByIsbn($isbn);
        return $data; 
    }

    /**
     * 获取书本信息
     * @param string $bookid
     * @param string $p
     * @return mixed
     */
    function getAnnotations($bookid='', $p='0'){
        $s = D('Douban', 'Service');
        $data = $s->getBookAnnotations($bookid, $p);
        return $data;
        
    }


    /**
     * 获取书本信息
     * @param $infotype bookinfo|annotations
     * @param $jkey 对应的关键词
     * @param string $jtype 关键词类型
     * @return string 返回值
    */
    function getBooksInfo($infotype, $jkey,$jtype = 'ISBN'){
        if(is_array($jkey)){
            $key = json_encode($jkey);
        }else{
            $key = $jkey;
        }
        $map = array(
            'infotype'=>$infotype,
            'jkey'=>$key,
            'jtype'=>$jtype,
        );
        $info = $this->where($map)->find();
        if(!$info){
            $s = D('Douban', 'Service');
            switch($jtype){
                case 'ISBN':
                    $data = $s->getBookInfoByIsbn($jkey);
                    break;
                case 'ANNOTATIONS':
                    $num = C('DOUBAN.NOP');
                    $id = $jkey['id'];
                    $p = $jkey['p'];
                    $start = $p*$num;
                    $data = $s->getBookAnnotations($id, $start, $num);
                    break;
                default: break;
            }
            if(isset($data->code) && ($data->code>999)){
                return 'error';
            }else{
                $info = array_merge((array)$info, $map);
                $info['create_time'] = time();
                $info['json'] = json_encode($data);
                $this->add($info);
            }
        }
        $ret['data'] = $info['json'];
        $ret['extra'] = array('vol'=>$info['vol'],'date'=>date('Y-M-d',$info['belong_date']),'brief'=>$info['brief']);  
        return $ret;
    }
    
    
    function getInfoFromDouBan(){
        
    }
    /**
     * 获取数据
     * @param string $field
     * @param $isbn
     * @return string
     */
    function getInfoField($isbn,$field=''){
        $ret = $this->getBookInfo('bookinfo', $isbn);
        if(empty($field)){
            return $ret;
        }
        $keys = array_flip(str2arr($field));
        $values = json_decode($ret, true);
        $data = array_intersect_key($values, $keys);
        return json_encode($data);
    }
}

?>