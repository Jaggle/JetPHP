<?php
/**
 * JET 邮件代理
 *
 * @package     jet agent
 * @author      Jake singviy@qq.com
 * @link        http://www.yeskn.com
 */


namespace Jet\Agent;

use PHPMailer;

class MailAgent extends CommonAgent
{
	//todo 需要权限控制
	function __construct()
	{

	}

	public static function send($receiver_mail,$receiver_name,$subject,$content,$from)
	{
		$mail = new PHPMailer();
		apply_config($mail,'smtp');
		$mail->isSMTP();
		$mail->isHTML(true);
		$mail->Subject  = $subject;
		$mail->Body     = $content;
		$mail->addAddress($receiver_mail,$receiver_name );     // Add a recipient
		if ($mail->send())
			return true;
		else
			return $mail->ErrorInfo;
	}


}