<?php
namespace V1\Controller;

use Think\Controller;
/**
 * 调试类
 * @author fren<frenlee@163.com>
 * @since 2015年5月11日
 */
class TestController extends Controller
{
    function index(){
        $this->display();
    }
    
    function ann(){
        $this->display();
    }

    function today(){

        $this->display();
    }
}

?>