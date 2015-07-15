<?php
namespace Admin\Model;

use Think\Model;
/**
 * 书本分类
 * @author fren<frenlee@163.com>
 * @since 2015年5月14日
 */
class TypeModel extends Model
{
    protected $_validate = array(
        array('title', 'require', '分类名称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '', '分类已经存在', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH),
    );
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('number', 0, self::MODEL_INSERT),
        array('status', 1, self::MODEL_INSERT),
    );
}

?>