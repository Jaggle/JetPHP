<?php

/**
 * Class AccountController
 * 账户管理控制器
 */

namespace Jet\Controller;
use Jet\Core\Controller;

class AccountController extends Controller
{
    function __call($name, $args)
    {
        die('你来到了错误的页面');
    }


    /**
     * 个人中心页面
     * @param $user string|number
     */
    public function index($user)
    {
        $p_user = "#[1-9]*[0-9]+#";
        if (preg_match($p_user, $user) == false)      //字符串
        {

            $user = $this->model('user')->where("user = '$user'")->get();        //得到一行记录
            if (!$user) {
                $this->error_404('该用户不存在!');
            }
            $this->assign(array(
                'user' => $user['user'],
            ), 1);
            $this->render();
        }
        if (preg_match($p_user, $user))               //用户id
        {

            $user = intval($user);

            $user = $this->model('user')->where($user)->get();        //得到一行记录

            $this->assign(array(
                'user' => $user['user'],
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
        } //提交登录
        else {
            $user = jet_Post('user');
            $pswd = jet_Post('pswd');
            $pswd = md5($pswd);
            $code = jet_Post('validate');

            //判断用户状态 ，有 verifying,ok,frozen
            $account_status = $this->model('user')->where("user = '$user'")->field('status');
            if ('frozen' === $account_status) {
                $this->redirect('你的账号已经被冻结！', 'R:home_page');
            }
            //尚未验证
            if ('verifying' === $account_status) {
                $this->set_cookie('v_user', $user);
                $this->render('notice/verifying');
            }
            if (isset($code) and !empty($code)) {
                if ($code == $this->get_session('authnum_session')) {

                } else {
                    echo jet_JSON(array('msg' => '验证码有误！', 'status' => 0));
                    return 0;
                }
            } else {
                echo jet_JSON(array('msg' => '请填写验证码！', 'status' => 0));
                return 0;
            }


            if ($this->model('user')->where("user = '$user'")->num() == 0) {
                echo jet_JSON(array('msg' => '不存在该用户！', 'status' => 0));
                return 0;
            }


            if ($pswd == $this->model('user')->where("user = '$user'")->field('pswd')) {


                //创建cookie
                //用户名加盐处理

                $identity = $this->model('user')->where("user = '$user'")->field('identity');


                $f1 = $this->set_cookie('user', $identity);

                $f2 = $this->set_session($user, '1');

                if ($f1 and $f2)
                    echo jet_JSON(array('msg' => '登录成功！', 'status' => 1));
                return 1;
            } else {

                echo jet_JSON(array('msg' => '密码有误！', 'status' => 0));
                return 0;
            }
        }

    }

    public function dologin()
    {
        echo "hello";
    }

    /**
     * 退出操作
     *
     */
    public function logout()
    {
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
     *
     */
    public function register()
    {

        if (jet_Post('action') === 'do_register') {
            $reg = jet_Post('reg');
            //说明    ？     - 匹配0次或者一次
            //		  \\    - 转义
            $p_mail = '/^[\w]+(\.[\w+])*@[\w-]+(\.[\w-]+)+$/i';
            $p_user = "#^[A-Za-z0-9\\-_]{3,20}#";
            $p_pswd = "#^[A-Za-z0-9\\-_]{8,20}#";
            //dump($reg,1);

            if (preg_match($p_mail, $reg['mail'])) {

            } else {


                $this->refresh('请输入正确的邮箱', 2);
            }
            if (preg_match($p_pswd, $reg['pswd'])) {

            } else {
                $this->refresh('请输入正确格式的密码', 2);
            }
            if (preg_match($p_user, $reg['user'])) {
                //判断是否有相同账号
                if ($this->model('user')->where("user = '" . $reg['user'] . "'")->num()) {
                    $this->redirect('已经存在相同名字的账号，请更换用户名！', 'R:login');
                }

            } else {
                $this->refresh('请输入正确格式的用户名', 2);
            }

            $salt = $this->config['jet_identity'];
            $reg['identity'] = md5($salt . $reg['user']);
            $reg['pswd'] = md5($reg['pswd']);

            //向数据库插入数据
            $flag = $this->model('user')->insert($reg);
            if ($flag) {
                //注册成功，发送验证码邮件，并显示验证页面
                $flag = $this->sendVerifyMail($reg);
                if ($flag)
                    echo 'Message has been sent';
                else {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $flag;
                }

            } else
                $this->redirect('注册失败！', 'R:login');

        } else {
            $this->redirect('nothing to do ', 'R:login', 0);
        }
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
     * @throws Exception
     * @throws phpmailerException
     */
    public function sendVerifyMail($reg)
    {

        $mail = new PHPMailer;
        $smtp_config = require(CONFIG . '/smtp.config.php');
        foreach ($smtp_config as $key => $value) {
            $mail->$key = $value;
        }
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        $mail->Subject = "请确认您在Jet上的邮箱";
        $mail->Body = "欢迎来到Jet<br/><br/>";
        $mail->Body .= "点击下面的链接来确认和激活你的新帐号：<br/><br/>";
        $mail->Body .= URL . "/account/activate/" . $reg['identity'] . "<br/>";
        $mail->Body .= "如果上面的链接无法点击，请拷贝该链接并粘贴到你的浏览器的地址栏里。";
        $mail->addAddress($reg['mail'], $reg['user']);     // Add a recipient
        if ($mail->send())
            return true;
        else
            return $mail->ErrorInfo;
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