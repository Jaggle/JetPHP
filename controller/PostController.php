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
        require_once(JET.'/common/functions.php');
    }

    /**
     * @param $id 需要展示的文章的ID
     *
     */
    public function index($id = null)
    {
        if($id)
        {

            $data = $this->model('post')->where($id)->get();
            if($data)
            {
                $this->assign('title', "夜色空凝");
                $this->model('post')->where($id)->increase('views','1');        //浏览次数+1


                $this->assign('id',$id);
                $this->assign('it',$data);

                //取得评论
	            $comment = $this->model('comment')->where("(attach = $id and type = 'post')")->select();      //
	           //dump($comment,1);
	            $this->assign('comment',$comment);

                $this->render();
            }else
            {
                $this->redirect('不存在此文章！','R:home_page');
            }

        }
        else
        {
            $this->redirect('不存在此页面！','R:home_page');
        }

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
        //判断用户是否已经登录
        if($this->is_login($this->current_user()) == false )
        {
            $this->redirect('请先登录','R:home_page');
        }
        if(jet_Post('action') !== 'do_publish')
        {
            $this->render('index/ueditor');
            exit();
        }
        else
        {
            $data = jet_Post('post');

            if($data['summary'] == false)
            {
                $data['summary'] = substr(strip_tags($data['content']),0,jet_config('summary_length'));
            }

            $data['publish_time'] = time();

            $data['author'] = $this->current_user();

            //dump($data);

            $flag = $this->model('post')->insert($data);

            if($flag)
                $this->redirect('添加文章成功！','R:home_page');
            else
                die('添加失败！');
        }
    }


    /**
     * 修改操作
     *
     */
    public function modify()
    {

    }


    /**
     * 删除文章
     * @return bool 删除成功返回真，否则返回假
     */
    public function delete()
    {
        $id = jet_Get('id');

        $flag = $this->model('post')->where($id)->delete();
        if($flag)
            $this->redirect('删除成功!',"R:home_page");
        else
            $this->redirect('删除失败!',"R:home_page");
    }

    /**
     * @note urlencode只接受字符串变量
     */
    public function JSON_list()
    {
        $data = $this->model('post')->select();

        foreach($data as $key => $value)
        {
            foreach($value as $k => $v)
            {
                $data[$key][$k] = urlencode($v);
            }
        }
        $data = json_encode($data);
        echo urldecode($data);
    }


}