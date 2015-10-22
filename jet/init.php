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
	$_list = explode('\\', $class);
	//当前类的组织有
	//  Jet/Core
	//  Jet/Agent
	//  Jet/Controller
	//在此版本中，$_list[0] == 'Jet;
	switch ($_list[1]) {
		case 'Agent' :
			file_exists(JET . "/agent/" . $_list[2] . '.php') && require_once JET . "/agent/" . $_list[2] . '.php';
			break;
		case 'Core':
			file_exists(JET . "/core/" . $_list[2] . '.class.php') && require_once JET . "/core/" . $_list[2] . '.class.php';
			break;
		case 'Controller':
			file_exists(CTL . '/' . $_list[2] . '.php') && require_once CTL . '/' . $_list[2] . '.php';
			break;
	}

}

spl_autoload_register('autoload');


// 判断当前是否为debug模式
// 尝试开启whoops处理异常

if (DEBUG == true) {
	error_reporting(E_ALL);
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();
	//$smarty->caching = false;//是否使用缓存
} else {
	error_reporting(0);

}



require_once(JET . '/jet.php');








