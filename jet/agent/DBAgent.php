<?php
/**
 * JET 数据库操作
 *
 * @package     jet agent
 * @author      Jake singviy@qq.com
 * @link        http://www.yeskn.com
 */

namespace Jet\Agent;
use Jet\Core;
use Whoops\Exception\ErrorException;

class DBAgent extends CommonAgent
{

	function __call($name,$args)
	{
		throw new ErrorException("不存在方法a".$name);
	}

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * 查找
	 */
	public function select()
	{

	}

	/**
	 * 删除
	 */
	public function delete()
	{
		$id     = jet_Post('id');
		$model  = jet_Post('model');
		$has = $this->model($model)->where($id)->delete();
		echo jet_JSON($this->execute($has));
		return ;


	}

	/**
	 * 更新
	 */
	public function update()
	{

	}

	/**
	 * 添加
	 */
	public function insert()
	{
		$data = jet_Post('data');

		dump($data,1);

		echo jet_JSON(array(
			'status' => true,
		));die;
	}

}