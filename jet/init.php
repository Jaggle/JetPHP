<?php
// +----------------------------------------------------------------------
// | Jakesoft Studio [ Anything can be done by Js will be done by Js. ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.yeskn.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Jake <singviy@qq.com>
// +----------------------------------------------------------------------

require_once(JET.'common/functions.php');
/**
 * debugģʽ
 */
if(DEBUG === true){
    error_reporting(E_ALL);
}else{
    error_reporting(0);
}


/**
 * ����session
 */

session_start();


//dump($_SESSION);


