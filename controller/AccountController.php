<?php
// +----------------------------------------------------------------------
// | Jakesoft Studio [ Anything can be done by Js will be done by Js. ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.yeskn.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Jake <singviy@qq.com>
// +----------------------------------------------------------------------

class AccountController extends CommonController
{
    function __call($name,$args){
        die('你来到了错误的页面');
    }



    /**
     * 登录操作
     */
    public function login()
    {
        //已经登录
        if($this->is_login($this->get_cookie('user')))
        {
            $this->redirect('您已经登录了哦','home_page');
        }

        //渲染模板
        if(jet_Post('action') != 'do_login')
        {
            $this->render('account/login');
        }
        //提交登录
        else
        {
            $user = jet_Post('user');
            $pswd =jet_Post('pswd');
            $pswd = md5($pswd);
            $code = jet_Post('validate');
            if(isset($code))
            {
                if($code == $this->get_session('authnum_session'))
                {

                }else
                {
                    $this->redirect('验证码有误！','R:login','1');
                }
            }else{
                $this->redirect('验证码有误！','R:login','1');
            }


            if($pswd == $this->model('user')->where("user = '$user'")->find('pswd'))
            {
                //创建cookie
                //用户名加盐处理
                $salt = $this->config['jet_identity'];
                $s = md5($salt+$user);

                $f1 = $this->set_cookie('user',$s);


                $f2 = $this->set_session($user,'1');

                $refer = jet_Post('backurl');


                if(empty($refer))
                    $refer = 'R:home_page';

                if($f1 and $f2)
                    $this->redirect('登录成功！',$refer,'1');
            }else
            {
                dump($this->model('user')->get_pswdByUserName($user));
                echo "登录失败！";
            }
        }

    }

    /**
     * 退出操作
     *
     */
    public function logout(){
        //尚未登录
        if(!$this->get_cookie('user'))
        {
            $this->redirect('你尚未登录哦','R:home_page');
            exit;
        }
        if($this->let_cookie('user'))
        {
            $this->redirect('退出成功！','R:home_page','2');
        }
        else
        {
            $this->redirect('退出失败！','R:home_page',2);
        }
    }


}