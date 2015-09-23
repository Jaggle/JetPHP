<?php

namespace Jet\Controller;
use Jet\Core\Controller;

class AjaxController extends Controller
{

    function __call($name, $args)
    {
        die('指定的方法不存在');
    }
    public function test()
    {
        $this->render();
    }


   public function mail()
   {
       if(jet_Post('action') == 'do_mailer')
       {
           error_reporting(0);
           $mail = new \PHPMailer();
           apply_config($mail,'smtp');
           $mail->isSMTP();// Set mailer to use SMTP
           $mail->addAddress(jet_Post('to'), 'HELLO');     // Add a recipient
           $mail->isHTML(true);                                  // Set email format to HTML
           $mail->Subject = '这是一架邮件轰炸机！';
           $content = jet_Post('content');
           if( ! $content)
           {
               $content = '这是一架邮件轰炸机！';
           }
           $mail->Body    =  $content;
           $mail->AltBody = strip_tags($content);
           if(!$mail->send())
           {
               echo jet_JSON(array('message' => '错误: ' . $mail->ErrorInfo, 'has' => false));
           }
           else
           {
               echo jet_JSON(array('message' => "你的邮件已经发送给".jet_Post('to').",内容是$content".$mail->Username, 'has' => true));
           }

       }
       else
       {
            $this->render();
       }
   }

}