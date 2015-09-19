<?php
session_start();

require_once(JET . '/common/functions.php');
require_once(CONFIG . '/const.config.php');
require JET . '/vendor/autoload.php';     //自动加载第三方类库

switch (jet_Config('template_engine')) {
    case 'twig':
        $loader = new Twig_Loader_Filesystem(VIEW);
        $TE = new Twig_Environment($loader);
        break;
    case 'smarty':
        $TE = new Smarty;
        apply_config($TE, 'smarty');
        break;
    default:
        $TE = new Smarty;
        apply_config($TE, 'smarty');
}

//$smarty = new Smarty;
//apply_config($smarty, 'smarty');

function autoload($class)
{
    if (strstr($class, 'Controller'))
        require_once(CTL . '/' . $class . '.php');

    elseif (strstr($class, '_MODEL'))
        require_once JET . '/jet_model.inc.php';

    elseif( ! strstr($class,'/') || !strstr($class,'\\'))
        require_once(JET . '/libs/' . $class . '.class.php');  //调用第三方类

}

spl_autoload_register('autoload');


/**
 * debug
 */
if (DEBUG == true) {
    error_reporting(E_ALL);
    //$smarty->caching = false;//是否使用缓存
} else {
    error_reporting(0);
    //$smarty->caching = true;

}

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$log = new Monolog\Logger('USER');
$log->pushHandler(new Monolog\Handler\StreamHandler(RUNTIME . '/logs/log.txt'));
$log->addInfo('加载jet.php核心文件', array('AGENT' => $_SERVER['HTTP_USER_AGENT']));

require_once(JET . '/jet.php');








