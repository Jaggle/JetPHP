<?php
/**
 * Created by PhpStorm.
 * User: Jake
 * Date: 2015/8/30
 * Time: 17:42
 */
//use Controller\CommonController;
//namespace Controller\MemberController;


class MemberController extends CommonController
{
    public function  index(){
        $this->display('member/index.html');
    }
}