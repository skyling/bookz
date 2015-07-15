<?php
/**
 * 错误代码
 */
    return array(
        'M_API'=>array(
           'SUCCESS_STATUS'=>'1',
           'SUCCESS'=>'操作成功!',
           'ERROR_STATUS'=>'0',
           'ERROR'=>'操作失败!',
           'METHOD'=>'请求方式错误',
           'METHOD_STATUS'=>'4001',
        ),
        'AJAX_STATUS' => array(
            'SUCCESS' => array(
                'info' => '200',
                'data' => '操作成功!',
                'status' => 1,
            ),
            'ERROR' => array(
                'info' => '4001',
                'data' => '操作失败',
                'status' => 0,
            ),
            'DB_FAULT' => array(
                'info' => '5001',
                'data' => '豆瓣请求失败',
                'status' => 0,
            )
        ),
    );
?>