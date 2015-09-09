<?php

require_once(JET.'/common/functions.php');

//路径-用于程序访问
define('CONFIG',JET.'/config');                   //配置文件路径
define('CTL', ROOT . '/controller');              //控制器目录
define('VIEW', ROOT . '/views/'.TEMPLATE);        //模板路径
define('RUNTIME', ROOT . '/runtime');             //运行时目录
define('VENDOR', JET.'/vendor');                  //第三方插件目录


//地址-用于网页访问
define('__STATIC__','/views/common/static');      //静态资源

//smarty配置
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = VIEW;
$smarty->compile_dir = RUNTIME . '/compile';
$smarty->config_dir = CONFIG ;
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
 * debug
 */
if(DEBUG === true){
    error_reporting(E_ALL);
    $smarty -> caching = false;//是否使用缓存
}else{
    error_reporting(0);
    $smarty -> caching = true;//是否使用缓存
}


session_start();





