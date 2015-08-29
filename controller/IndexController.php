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
       
	   global $smarty;
       $smarty->display('index.html');
    }
    public function explore(){
        echo "欢迎来到发现页面！";
    }
    public function search(){
        echo "这是search方法";
    }
}