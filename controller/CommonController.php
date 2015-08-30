<?php
/**
 * Created by PhpStorm.
 * User: Jake
 * Date: 2015/8/30
 * Time: 15:41
 */


//namespace Controller\CommonController;

class CommonController
{

    function __construct(){

    }
    public function display($temp){
        global $smarty;
        $smarty->display($temp);
    }
    public function assign($vname,$varible){
        global $smarty;
        $smarty->assign($vname,$varible);
    }
}