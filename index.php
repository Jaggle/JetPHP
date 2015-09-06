<?php


//默认所有的路径都带有最后的/
//这个文件设置程序的基础信息
define('URL','yeskn.dev');
define('ROOT', dirname(__FILE__) . '/');
define('CTL', dirname(__FILE__) . '/controller/');
define('VIEW', ROOT . 'views/default');
define('RUNTIME', ROOT . '/runtime/');
define('JET', ROOT . '/jet/');
define('DEBUG',true);
define('SMARTY_DIR', ROOT . '/smarty/');
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = VIEW;
$smarty->compile_dir = RUNTIME . '/compile/';
$smarty->config_dir = JET . '/config/';
$smarty->cache_dir = RUNTIME . '/cacha/';
require_once(JET . 'jet.php');



function autold($class)
{
    if(strstr($class,'Controller'))
    {
        require_once(CTL . $class . '.php');
    }
    if(strstr($class,'class'))
    {
        require_once('model/'.$class.'.php');

    }
    if(strstr($class,'_MODEL'))
    {
        //dump(debug_backtrace());
        require_once JET.'jet_model.inc.php';
    }
}

spl_autoload_register('autold');



require_once(JET.'init.php');
require_once(JET.'common/functions.php');


jet::start();