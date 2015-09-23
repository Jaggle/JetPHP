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

function autoload($class)
{
	$_list = explode('\\',$class);
	switch($_list[1])
	{
		case 'Agent' :
			require_once JET . "/agent/".$_list[2].'.php';
			return;
			break;
		case 'Model':
			require_once JET . "/".$_list[0].'/'.$_list[1].'.php';
			return;
			break;
		case 'Core':
			require_once JET . "/core/".$_list[2].'.class.php';
			return;
			break;
		case 'Jet':
			require_once JET . "/".$_list[0].'/'.$_list[1].'.php';
			return;
			break;
		case 'Controller' :
			require_once CTL. "/".$_list[2].'.php';
			return;
			break;
	}

}

spl_autoload_register('autoload');


/**
 * debug
 */
if (DEBUG == true) {
    error_reporting(E_ALL);
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();
	    //$smarty->caching = false;//是否使用缓存
} else {
    error_reporting(0);

}




$log = new Monolog\Logger('USER');
$log->pushHandler(new Monolog\Handler\StreamHandler(RUNTIME . '/logs/log.txt'));
$log->addInfo('加载jet.php核心文件', array('AGENT' => $_SERVER['HTTP_USER_AGENT']));

require_once(JET . '/jet.php');








