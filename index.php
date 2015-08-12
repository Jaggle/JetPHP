<?php

	//默认所有的路径都带有最后的/
	//这个文件设置程序的基础信息
	define('ROOT',dirname(__FILE__));
	define('CTL',dirname(__FILE__).'/controller/');
	define('JET',ROOT.'/jet/');
	require_once(JET.'jet.php');

	jet::start();