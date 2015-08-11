<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/11
 * Time: 13:14
 */

namespace Controller;


class IndexController
{
    function __call($name,$args){
        die('指定的方法不存在！');
    }
    public function index(){
        $this->render(
            'index.html',
            ''
        );
    }
}