<?php

require_once(JET.'/common/functions.php');

//路径
define('CONFIG_PATH',ROOT);
define('CTL', ROOT . '/controller');
define('VIEW', ROOT . '/views/default');
define('RUNTIME', ROOT . '/runtime');
define('VENDOR', JET.'/vendor');


//地址
define('__STATIC__','/views/static');

//smarty配置
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = VIEW;
$smarty->compile_dir = RUNTIME . '/compile';
$smarty->config_dir = JET . '/config';
$smarty->cache_dir = RUNTIME . '/cache';
$smarty -> left_delimiter="{{";
$smarty -> right_delimiter="}}";

require_once(JET . '/jet.php');



function autold($class)
{
    if(strstr($class,'Controller'))
    {
        require_once(CTL .'/'. $class . '.php');
    }
    if(strstr($class,'class'))
    {
        require_once('model/'.$class.'.php');

    }
    if(strstr($class,'_MODEL'))
    {
        //dump(debug_backtrace());
        require_once JET.'/jet_model.inc.php';
    }
}

spl_autoload_register('autold');





/**
 * debugģʽ
 */
if(DEBUG === true){
    error_reporting(E_ALL);
    $smarty -> caching = false;//是否使用缓存
}else{
    error_reporting(0);
    $smarty -> caching = true;//是否使用缓存
}


session_start();





