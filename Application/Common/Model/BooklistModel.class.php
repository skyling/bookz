<?php
namespace Common\Model;

use Think\Model;

class BooklistModel extends Model
{
    //自动验证
    protected $_validate = array(
        array('bookid', '', '该书已存在！', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH),
    );
    
    //自动完成
    protected $_auto = array(
        array('uid', 'get_admin_uid', self::MODEL_INSERT, 'function'),
        array('tagid', 'arr2str', self::MODEL_INSERT, 'function'),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', 1, self::MODEL_INSERT),
    );

    /**
     * 获取一项
     * @param $id
     * @param string $field
     * @param bool $where
     * @return bool|mixed
     */
    public function getItem($id, $field="*", $where=FALSE){
        !$where || $this->where($where);
        $this->field($field);
        $data = $this->find($id);
        return $data ? $data : FALSE;
    }

    function _after_find(){

    }
}

?>