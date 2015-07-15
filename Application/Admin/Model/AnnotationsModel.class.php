<?php
namespace Admin\Model;

use Think\Model;
/**
 * 读书笔记
 * @author fren<frenlee@163.com>
 * @since 2015年5月16日
 */
class AnnotationsModel extends Model
{
    //自动验证
    protected $_validate = array(
        //array('isbn', '', '该书已存在！', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH),
    );
    
    //自动完成
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('status', 1, self::MODEL_INSERT),
    );
    

    /**
     * 添加数据
     * @param string $bookid
     * @param string $data
     * @return boolean
     * @author frenlee <frenlee@163.com>
     * @since 2015年5月16日 下午11:20:02
     */
    function addData($bookid='',$data = ''){
        if(empty($data)|| empty($bookid))return false;
        $adata = array(
            'bookid'=>$bookid,
            'abstract'=>$data->abstract,
            'content'=>$data->content,
            'author_user'=>json_encode($data->author_user),
            'time'=>$data->time,
            'page_no'=>$data->page_no,
            'photos'=>json_encode($data->photos),
            'create_time'=>time(),
            'status'=>1,
        );
        return $this->add($adata);
    }
    
    /**
     * 查找后的处理
     * (non-PHPdoc)
     * @see \Think\Model::_after_select()
     */
    protected function _after_select(&$data, $options){
        if(!empty($data)){
            foreach ($data as $key=>$val){
                $user = json_decode($val['author_user']);
                unset($data[$key]['author_user']);
                $data[$key]['author_user']['name'] = $user->name;
                $data[$key]['author_user']['avatar'] = $user->avatar;
            }
        }
    }
}

?>