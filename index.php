<?php


define('ROOT', dirname(__FILE__));

define('JET', ROOT . '/jet');

//网站域名
define('URL','http://jetstar.dev');

//开发者模式
define('DEBUG',true);

//smarty路径
define('SMARTY_DIR', JET . '/vendor/smarty/');

//默认模板名称，对应views目录下的路径
define("TEMPLATE",'default');

//初始化运行环境
require_once(JET.'/init.php');

//everythis is ready, let's go !
jet::start();