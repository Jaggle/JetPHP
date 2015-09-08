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
        if(@$_POST['action'] != 'do_login')
        {
            $this->render();
        }
        //提交登录
        else
        {
            $user = $_POST['user'];
            $pswd = $_POST['pswd'];
            $pswd = md5($pswd);


            if($pswd == $this->model('user')->where("user = '$user'")->find('pswd'))
            {
                //创建cookie
                //用户名加盐处理
                $salt = $this->config['jet_indentifier'];
                $s = md5($salt+$user);
                //dump($s);
                $this->set_cookie('user',$s);
                $this->set_session($user,'1');

                //dump($_SESSION);
                $this->redirect('登录成功！','home_page');
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
            $this->redirect('你尚未登录哦','home_page');
            exit;
        }
        if($this->let_cookie('user'))
        {
            $this->redirect('退出成功！','home_page');
        }
        else
        {
            $this->redirect('退出失败！','home_page');
        }
    }


}