<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/11
 * Time: 13:14
 */




class IndexController
{
    function __call($name,$args){
        die('指定的方法不存在');
    }
    public function index(){
       echo "欢迎来到首页";
    }
    public function explore(){
        echo "欢迎来到发现页面！";
    }
}