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
        die('ָ���ķ��������ڣ�');
    }
    public function index(){
        $this->render(
            'index.html',
            ''
        );
    }
}