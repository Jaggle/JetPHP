<?php
/**
 * JET ���ݿ����
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
		throw new ErrorException("�����ڷ���a".$name);
	}

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * ����
	 */
	public function select()
	{

	}

	/**
	 * ɾ��
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
	 * ����
	 */
	public function update()
	{

	}

	/**
	 * ���
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