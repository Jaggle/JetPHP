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

    /**
     * 发布文章功能
     * data有如下键：
     *      title 标题
     *      summary 摘要
     *      content 内容
     *      publish_time 发布时间
     *      author 作者
     *      @todo cover 封面图片的路径 默认在uploads/image目录并且用时间隔开
     *
     *
     */
    public function publish()
    {
        if($_POST['action'] !== 'do_publish')
        {
            $this->render();
            exit();
        }
        else
        {
            $data = jet_Get('publish');


            if($data['summary'] == '')
            {
                $data['summary'] = substr($data['content'],0,jet_config('summary_length'));
            }

            $data['publish_time'] = time();

            $data['author'] = $this->model('user')->current_user_name();
        }


    }
}