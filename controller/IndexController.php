<?php


namespace Jet\Controller;

use Jet\Core\Controller;
use Jet\Core\Image;
use Jet\Core\ValidateCode;
use Jet\Core\Crypt;
use PHPMailer;

class IndexController extends Controller
{

    function __call($name, $args)
    {
        $this->error_404();

    }

    public function index()
    {
        //文章列表
        $posts = $this->model('post')->order('publish_time DESC')->limit(6)->select();
        foreach ($posts as $key => $value) {
            foreach ($value as $k => $v) {
                $posts[$key]['summary'] = strip_tags($posts[$key]['summary']);
                $posts[$key]['content'] = strip_tags($posts[$key]['content']);
            }
        }

        //热门文章
        $hots = $this->model('post')->order('views DESC')->limit(6)->select();
        $this->assign('hots', $hots);
        $this->assign('posts', $posts);
        $this->assign('variables',
            array(
                'user' => 'sb',

            )
        );

        $this->render();

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
        if (@$_POST['action'] != 'upload') {
            $this->render();
        } else {
            if ($_FILES['img']['error'] > 0) {
                die("ERROR :" . $_FILES["file"]["error"]);
            }
            echo jet_Upload('', 'image') ? '上传成功！' : "上传失败！";


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
        $_vc = new ValidateCode();//实例化一个对象
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
        $mail->Body = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
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
        if (jet_Post('id')) {
            $id = jet_Post('id');
            $list = $this->model('post')->where("id > $id")->get();
            if ($list) {
                //$list = array_slice($list,0,2);
                $list['has'] = true;
                foreach ($list as $key => $value) {
                    $list[$key] = str_replace('"', '\'', $value);       //替换双引号
                    $list[$key] = str_replace(':', '|=|', $list[$key]);             //替换冒号
                }

                echo jet_JSON($list);
                return;
            } else {
                $list['has'] = false;
                echo jet_JSON($list);
                return;
            }
        } else {
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

    public function twig()
    {

        $this->assign('name', '现在全面支持twig');
        $this->render();
    }

    public function rypt()
    {
        echo "加密的字符串是：" . "jakesoft" . PHP_EOL;
        $cr = new Crypt();
        $cr_string = $cr->encrypt('jakesoft', 'a key', 5);
        echo "加密后的字符串是:" . $cr_string . PHP_EOL;
        $de = $cr->decrypt($cr_string, 'a key');
        echo "解密后的字符串是：" . $de . PHP_EOL;

    }

    public function img()
    {
        $image = new Image();
        $image->open(UPLOADS . '/post/d.png')->crop(100, 100, 0, 0, 50, 50)->save(UPLOADS . '/post/d2.png');
    }

    public function upyun()
    {
        ignore_user_abort(true);
        set_time_limit(0);
        $cfg_up = require(CONFIG . '/upyun.config.php');
        $upyun = new \UpYun($cfg_up['bucket'], $cfg_up['user'], $cfg_up['pswd'], \UpYun::ED_TELECOM);
        $opts = array(
            \UpYun::X_GMKERL_THUMBNAIL => 'square' //创建缩略图,该参数仅适用于图片空间
        );

        $lo_file = UPLOADS . '/post/14.jpg';
        $up_file = '/dddd/ok/6duplodaddd.jpg';
        $fh = fopen($lo_file, 'r');
        $upyun->writeFile($up_file, $fh, true, $opts);
        $up_url = "http://" . $cfg_up['bucket'] . '.b0.upaiyun.com' . $up_file;
        fclose($fh);
    }

    public function qiniu()
    {

        $accessKey = 'SFq5DgIU7IzesR-xs6JvwLOs7cZyDde3baLdu1Oj';
        $secretKey = 'gu--J_yaqKjdgNrfpmsUiE2nnEvza6TiIFyEGG2U';
        $auth = new \Qiniu\Auth($accessKey, $secretKey);
        $bucket = 'jetstar';
        $token = $auth->uploadToken($bucket);
        $filePath = UPLOADS . '/post/d.png';
        $key = 'her-php-logo.png';
        $uploadMgr = new \Qiniu\Storage\UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            dump($err);
        } else {
            dump($ret);
        }
    }


}