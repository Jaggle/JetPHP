<?php

/**
 * Jet�����࣬�����඼��Ҫ�̳д���
 *
 */
namespace Jet\Core;

class Jet
{
	function __call($name,$args)
	{
		jet_log('���Է���Jet\Core\Jet�Ĳ����ڵķ���'.$name);
	}

}