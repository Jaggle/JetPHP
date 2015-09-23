<?php

/**
 * Class AccountController
 * 账户管理控制器
 */

namespace Jet\Controller;

use Jet\Agent\MailAgent;
use Jet\Core\Controller;
use PHPMailer;
use Whoops\Exception;

class AccountController extends Controller
{
	function __call($name, $args)
	{
		$this->error_404();
	}


	/**
	 * 本控制器默认进入 个人中心页面
	 * @param $user string|number
	 */
	public function index($user)
	{
		$name = $user;
		$p_user = "#[1-9]*[0-9]+#";
		if (preg_match($p_user, $user) == false)      //字符串
		{
			$user = $this->model('user')->where("user = '$user'")->get();        //得到一行记录
			if (!$user)
				$this->error_404('该用户不存在!');

			$posts = $this->model('post')->where("author = '$name'")->order("publish_time DESC")->select();
			$this->assign(array(
				'user'  => $user['user'],
				'posts' => $posts
			), 1);
			$this->render();
		}
		if (preg_match($p_user, $user))               //用户id
		{

			$user = intval($user);
			$user = $this->model('user')->where($user)->get();        //得到一行记录
			if (!$user)
				$this->error_404('该用户不存在!');
			$posts = $this->model('post')->where($name)->order("publish_time DESC")->select();
			$this->assign(array(
				'user'  => $user['user'],
				'posts' => $posts
			), 1);
			$this->render();
		}
	}


	/**
	 * 登录操作
	 */
	public function login()
	{
		//已经登录
		if ($this->is_login()) {
			$this->redirect('这段话没啥用', 'R:home_page', 0);
		}

		//渲染模板
		if (jet_Post('action') != 'do_login') {
			$this->render('account/login');
		} else {
			//提交登录
			$user = jet_Post('user');
			$pswd = jet_Post('pswd');
			$pswd = md5($pswd);
			$code = jet_Post('validate');

			//判断用户状态 ，有 verifying,ok,frozen
			$account_status = $this->model('user')->where("user = '$user'")->field('status');
			if ('frozen' === $account_status) {
				echo jet_JSON(array('msg' => '你的账号已经被冻结！', 'status' => 0)) and die();
			}
			//尚未验证
			if ('verifying' === $account_status) {
				echo jet_JSON(array('msg' => '您的账号尚未验证邮箱！', 'status' => 0)) and die();
			}
			if (isset($code) and !empty($code)) {
				if ($code == $this->get_session('authnum_session')) {
				} else {
					echo jet_JSON(array('msg' => '验证码有误！', 'status' => 0)) and die();
				}
			} else {
				echo jet_JSON(array('msg' => '请填写验证码！', 'status' => 0)) and die();
			}
			if ($this->model('user')->where("user = '$user'")->num() == 0) {
				echo jet_JSON(array('msg' => '不存在该用户！', 'status' => 0)) and die();
			}
			if ($pswd == $this->model('user')->where("user = '$user'")->field('pswd')) {
				//创建cookie
				//用户名加盐处理
				$identity = $this->model('user')->where("user = '$user'")->field('identity');
				$f1 = $this->set_cookie('user', $identity);
				$f2 = $this->set_session($user, '1');
				if ($f1 and $f2)
					echo jet_JSON(array('msg' => '登录成功！', 'status' => 1)) and die();
			} else {
				echo jet_JSON(array('msg' => '密码有误！', 'status' => 0)) and die();
			}
		}

	}

	/**
	 * 退出操作
	 *
	 */
	public function logout()
	{
		//接受ajax请求
		if (jet_Get('r') == 'ajax') {
			$_SERVER['REQUEST_METHOD'] == 'POST' or die('welcome to jet');
			if (!$this->get_cookie('user')) {
				$array = array(
					'msg' => '您尚未登录',
					'has' => false
				);
			} elseif ($this->let_cookie('user')) {
				$array = array(
					'msg' => '退出成功',
					'has' => true
				);
			} else {
				$array = array(
					'msg' => '退出失败',
					'has' => 'false'
				);
			}
			echo jet_JSON($array);
			exit;

		}
		//尚未登录
		if (!$this->get_cookie('user')) {
			$this->redirect('你尚未登录哦', 'R:home_page');
			exit;
		}
		if ($this->let_cookie('user')) {
			$this->redirect('退出成功！', 'R:home_page', '2');
		} else {
			$this->redirect('退出失败！', 'R:home_page', 2);
		}
	}

	/**
	 * 注册功能
	 */
	public function register()
	{

		if (jet_Post('action') === 'do_register') {
			$mail = jet_Post('mail');
			$user = jet_Post('user');
			$pswd = jet_Post('pswd');
			$p_mail = '/^[\w]+(\.[\w+])*@[\w-]+(\.[\w-]+)+$/i';
			$p_user = "#^[A-Za-z0-9\\-_]{3,20}#";
			$p_pswd = "#^[A-Za-z0-9\\-_]{3,20}#";
			if (!preg_match($p_mail, $mail)) {
				echo jet_JSON(array(
					'msg' => '请输入正确的邮箱格式',
					'has' => false
				));
				return;
			} elseif (!preg_match($p_pswd, $pswd)) {
				echo jet_JSON(array(
					'msg' => '请输入正确的密码，长度在3-20之间',
					'has' => false
				));
				return;
			} elseif (preg_match($p_user, $user)) {
				//判断是否有相同账号
				if ($this->model('user')->where("user = '" . $user . "'")->num()) {
					echo jet_JSON(array(
						'msg' => '已经存在相同用户，请修改您的名字',
						'has' => false
					));
					return;
				} else {
				};//everything is ok
			} else {
				echo jet_JSON(array(
					'msg' => '用户名格式不正确，请不要输入字符，长度在3-20之间',
					'has' => false
				));
				return;
			}
			$salt = jet_Config('jet_identity');
			$reg['identity'] = md5($salt . $user);  //识别码加密
			$reg['pswd'] = md5($pswd);              //密码MD5加密
			$reg['user'] = $user;
			$reg['mail'] = $mail;
			$reg['fans'] = jet_Config('register_fans');
			$reg['type'] = jet_Config('register_type');
			$reg['register_time'] = date('Y-m-d h:i:s', time());
			$reg['status'] = jet_Config('register_status');

			//向数据库插入数据
			$flag = $this->model('user')->insert($reg);
			if ($flag) {
				$flag = $this->sendVerifyMail($reg);
				if ($flag)
					echo jet_JSON(array(
						'msg' => '注册成功！',
						'has' => true
					));
				else echo jet_JSON(array(
						'msg' => '程序出现错误，希望你能将这个错误反馈给我们！错误代码:ERROR_REG_01',
						'has' => false
					));
			} else echo jet_JSON(array(
					'msg' => '程序出现错误，希望你能将这个错误反馈给我们！错误代码:ERROR_REG_02',
					'has' => false
				));
		} else echo jet_JSON(array(
				'msg' => '程序出现错误，希望你能将这个错误反馈给我们！错误代码:ERROR_REG_03',
				'has' => false
			));
	}

	/**
	 * @param $ac_code
	 */
	public function activate($ac_code)
	{
		$user_status = $this->model('user')->where("identity = '$ac_code'")->field('status');
		if ($user_status === 'verifying') {
			$flag = $this->model('user')->where("identity = '$ac_code'")->setField('status', 'ok');
			if ($flag)
				echo "恭喜，您验证成功了！";
			else
				echo "验证失败！";
		} else {
			echo "链接已经失效！";
		}

	}

	/**
	 * @param $reg
	 * @return bool|string
	 */
	public function sendVerifyMail($reg)
	{
		$subject = "请确认您在Jet上的邮箱";
		$content = "欢迎来到Jet" . "<br/><br/>";
		$content .= "点击下面的链接来确认和激活你的新帐号：" . "<br/><br/>";
		$content .= URL . "/account/activate/" . $reg['identity'] . "<br/>";
		$content .= "如果上面的链接无法点击，请拷贝该链接并粘贴到你的浏览器的地址栏里。";
		$has = MailAgent::send($reg['mail'], $reg['user'], $subject, $content, 'Jet');
		return $has;
	}

	public function do_sendVerifyMail()
	{
		$reg['user'] = $this->get_cookie('v_user');
		$user = $reg['user'];
		if (!$user)
			exit;

		if ($this->model('user')->where("user = '$user'")->field('status') === 'ok') {
			$this->redirect('您已经验证过邮箱，无需再进行验证', 'R:login', 2);
		}

		$reg['identity'] = $this->model('user')->where("user = '$user'")->field('identity');
		$reg['mail'] = $this->model('user')->where("user = '$user'")->field('mail');

		if ($this->sendVerifyMail($reg))
			echo "邮件发送成功";
		else
			echo "邮件发送失败！";

	}
}