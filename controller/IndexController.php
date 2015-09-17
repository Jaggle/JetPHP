<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/11
 * Time: 13:14
 */
class IndexController extends CommonController
{

    function __call($name, $args)
    {
        die('指定的方法不存在');
    }

    public function index()
    {

        //文章列表
        $posts = $this->model('post')->order('publish_time DESC')->limit(6)->select();

        foreach($posts as $key =>$value)
        {
            foreach($value as $k => $v)
            {
                $posts[$key]['summary'] = strip_tags($posts[$key]['summary']);
                $posts[$key]['content'] = strip_tags($posts[$key]['content']);
            }
        }


        //热门文章
	    $hots = $this->model('post')->order('views DESC')->limit(6)->select();

	    $this->assign('hots',$hots);

        $this->assign('posts',$posts);

	    $this->assign('variables',
		    array(
			    'user' => 'jake',

		    )
	    );

        $this->render();
    }

    /**
     * 文章详细页面，但是要传一个id的值确定是哪一篇文章
     * @author Jake
     *
     */
    public function post(){
        //没有指定文章的id
        if(!isset($_GET['id'])){
            //提示错误页面并且跳转到首页
            $this->error('你请求的页面不存在,因为你没有具体指定文章的ID','index');
            return;
        }
        //不是数字
        else if(!is_numeric($_GET['id']) or $_GET['id'] < 1){
            $this->error('这不是有效的文章ID','index');
            return;
        }
        else{
            die('dsd');
        }



    }
    public function explore()
    {
        echo "欢迎来到发现页面！";
    }

    public function search()
    {
        echo "这是search方法";
    }


	/**
	 * 文件上传测试
	 *
	 */
    public function up()
    {
        if ( @$_POST['action'] != 'upload') {
            $this->render();
        } else {
            if ($_FILES['img']['error'] > 0) {
                die("ERROR :" . $_FILES["file"]["error"]);
            }
            echo jetUpload('', 'image') ? '上传成功！' : "上传失败！";


        }
    }

	/**
	 * 百度ueditor测试
	 */
	public function ueditor()
	{
		$this->render();
	}

    /**
     * code_generate
     */
    public function code_generate()
    {
        $_vc = new ValidateCode();  //实例化一个对象
        $_vc->doimg();
        $_SESSION['authnum_session'] = $_vc->getCode();//验证码保存到SESSION中
    }

    /**
     * validate code
     */
    public function validate()
    {

        $this->render();
    }

    /**
     * phpmailer
     */
    public function mailer()
    {
       // require 'PHPMailerAutoload.php';

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.qq.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'singviy@qq.com';                 // SMTP username
        $mail->Password = 'mycaihong';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->From = 'singviy@qq.com';
        $mail->FromName = 'Jet';
        $mail->addAddress('singviy@qq.com', 'Joe User');     // Add a recipient
        //$mail->addAddress('singviy@qq.com');               // Name is optional
        //$mail->addReplyTo('isingviy@qq.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    /**
     * 长轮询测试
     */
	public function polling()
	{
		if(jet_Post('id'))
		{
			$id = jet_Post('id');
			$list = $this->model('post')->where("id > $id")->get();
			if($list){
				//$list = array_slice($list,0,2);
				$list['has'] = true;
				foreach($list as $key => $value){
					$list[$key] = str_replace('"','\'',$value);       //替换双引号
					$list[$key] = str_replace(':','|=|',$list[$key]);             //替换冒号
				}

				echo jet_JSON($list);
				return;
			}
			else
			{
				$list['has'] = false;
				echo jet_JSON($list);
				return;
			}
		}
		else
		{
			$this->render();
		}
	}

	/**
	 * 模态框
	 */
	public function modal()
	{
		$this->render();
	}

}