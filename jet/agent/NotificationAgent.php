<?php
/**
 * JET 消息发送代理
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
	 * 将消息设置为已读
	 *
	 */
	public function setRead()
	{
		echo "set read";
	}

	/**
	 * 发送消息
	 */
	public function sendMessage()
	{

	}

	/**
	 * ajaxGet 接收消息
	 * 接收用户消息，系统消息，todo 群组消息
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
				'not'       => $not,        //注意 $not是一个二维数组,那么整个echo的是一个三维数组
				'msg'       => "got $notNum new message",
				'has'       => true,
				'notNum'    => $notNum
			));
		}
	}
}