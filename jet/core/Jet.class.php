<?php

/**
 * Jet核心类，所有类都需要继承此类
 *
 */
namespace Jet\Core;

class Jet
{
	function __call($name,$args)
	{
		jet_log('尝试访问Jet\Core\Jet的不存在的方法'.$name);
	}

}