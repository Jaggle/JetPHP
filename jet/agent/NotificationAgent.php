<?php
/**
 * JET ��Ϣ���ʹ���
 *
 * @package     jet agent
 * @author      Jake singviy@qq.com
 * @link        http://www.yeskn.com
 */

namespace Jet\Agent;

use Jet\Core\Controller;

class NotificationAgent extends CommonAgent
{

	function __construct()
	{

	}

	/**
	 * ����Ϣ����Ϊ�Ѷ�
	 *
	 */
	public function setRead()
	{
		echo "set read";
	}

	/**
	 * ������Ϣ
	 */
	public function sendMessage()
	{

	}

	/**
	 * ajaxGet ������Ϣ
	 * �����û���Ϣ��ϵͳ��Ϣ��todo Ⱥ����Ϣ
	 */
	public function ajaxGet()
	{

		$con = new Controller();
		$current_user = $con->current_user();
		$not = $this->model('notification')->where("is_read = 0 and receiver = 'ALL_USER' or receiver = '$current_user' ")->select();
		if (!$not) {
			echo jet_JSON(array(
				'notNum'    => 0,
				'has'       => false
			));
		} else {
			$notNum = count($not);
			echo jet_JSON(array(
				'not'       => $not,        //ע�� $not��һ����ά����,��ô����echo����һ����ά����
				'msg'       => "got $notNum new message",
				'has'       => true,
				'notNum'    => $notNum
			));
		}
	}
}