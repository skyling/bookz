<?php
namespace Common\Model;

use Think\Model;
/**
 * 书本信息表
 * @author fren<frenlee@163.com>
 * @since 2015年5月15日
 */
class BookinfoModel extends Model{
    //自动验证
    protected $_validate = array(
        //array('isbn', '', '该书已存在！', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH),
        array('isbn13', '', '该书已存在！', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH),
    );
    
    //自动完成
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('images', 'json_encode', self::MODEL_BOTH, 'function'),
        array('author', 'json_encode', self::MODEL_BOTH, 'function'),
        array('status', 1, self::MODEL_INSERT),
    );

    /**
     * 添加书籍
     * @param $data
     */
    public function addBook($data){
        echo "add";
    }

    /**
     * 获取书本信息
     * @param bool $isbn
     * @return string
     */
    public function getItem($bookid, $field='*', $where=FALSE){
        if(!$bookid) return FALSE;
        $this->where(array('bookid'=>$bookid));
        echo $bookid;
      //  !$where || $this->where($where);
        $this->field($field);
        $data = $this->find();
        echo $this->buildSql();
        return $data ? $data : FALSE;
    }


    function _after_find(&$data,$options){
        $data['author'] = json_decode($data['author']);
        $data['images'] = json_decode($data['images']);

    }
}

?>