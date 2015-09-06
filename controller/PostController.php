<?php
// +----------------------------------------------------------------------
// | Jakesoft Studio [ Anything can be done by Js will be done by Js. ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.yeskn.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Jake <singviy@qq.com>
// +----------------------------------------------------------------------


class PostController extends CommonController
{
    function __call($name, $args)
    {
        //dump(debug_backtrace());
        die('the method does not exist ');
    }
    function __construct()
    {
        parent::__construct();
        require_once(JET.'common/functions.php');
    }


    public function index($id)
    {

        $post_data = $this->model('post')->get_post_list('',$id,3,'id','');

        $this->assign('title', "夜色空凝");
        $this->assign('id',$id);
        $this->assign('post',$post_data);
        $this->assign('cookie',$_COOKIE);
        $this->render();

    }

    public function test(){
       $this->redirect('login');
    }
}