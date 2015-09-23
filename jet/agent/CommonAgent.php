<?php
/**
 * JET 数据库操作代理
 *
 * @package     jet agent
 * @author      Jake singviy@qq.com
 * @link        http://www.yeskn.com
 */
namespace Jet\Agent;

use Jet\Core\Model;
use Whoops\Exception\ErrorException;

class CommonAgent
{
	function __call($name,$args)
	{
		throw new ErrorException("不存在方法".$name);
	}

	function __construct()
	{

	}


	protected function model($model)
	{
		return new Model($model);
	}

	protected function execute($has,$data = null)
	{
		if($has)
			return array(
				'status'    => true,
				'message'   => 'succeed',
				'data'      => $data
			);
		else
			return array(
				'status'    => false,
				'message'   => 'Failed',
				'data'      => $data
			);

	}

}

