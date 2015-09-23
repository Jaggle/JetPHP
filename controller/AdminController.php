<?php

namespace Jet\Controller;

use Jet\Core\Controller;

class AdminController extends Controller
{
    public $p = '';     //position
    public $a = '';     //action

    function __call($name, $args)
    {
       $this->error_404();

    }

    function __construct()
    {
        parent::__construct();
        if ($this->is_login() == false) {
            $this->redirect('请先登录', 'R:home_page', '1');
        }
        $this->p = jet_Get('p');
        $this->a = jet_Get('a');

    }

    public function index()
    {

        if ($this->p != '') {
            $p = $this->p;
            $this->$p();
            exit();
        } else {
            $c_u = $this->current_user();
            $comment_num = $this->model('comment')->num();  //评论数
            $fans_num = $this->model('user')->where("user = '$c_u'")->field('fans_num');
            $post_num = $this->model('post')->num();
            $site_view = $this->model('site')->where(" `key` = 'views'")->field('value');

            $this->assign(array(
                'fans_num' => $fans_num,
                'comment_num' => $comment_num,
                'post_num' => $post_num,
                'site_view' => $site_view,
            ), '');

            $this->render('');
        }


    }

    public function typography()
    {
        $this->render();
    }

    public function gallery()
    {
        $this->render();

    }

    public function elements()
    {
        $this->render();

    }

    public function buttons()
    {
        $this->render();

    }

    public function treeview()
    {
        $this->render();

    }

    public function jquery_ui()
    {
        $this->render();

    }


    /**
     * 文章管理
     */
    public function post()
    {
        //显示文章列表
        if ($this->a == '' or $this->a == 'index' or $this->a == 'list') {
            $list = $this->model('post')->select();
            foreach ($list as $key => $value) {
                foreach ($value as $k => $v) {
                    if ($k == 'summary') {
                        $list[$key][$k] = strip_tags($v);
                    }
                }
            }
            $this->assign('list', $list);
            $this->render('admin/post/index');
        }

        //发布文章
        if ($this->a == 'publish') {
            if (jet_Post('action') == 'do_publish') {
                $data['title'] = jet_Post('title');
                $data['summary'] = jet_Post('summary');
                $data['content'] = jet_Post('content');

                if ($data['summary'] == false) {
                    $data['summary'] = substr(strip_tags($data['content']), 0, jet_config('summary_length'));
                }

                //$data['publish_time'] = time();

                $data['views'] = mt_rand(19, 45);

                $data['author'] = $this->current_user();

                //dump($data);

                $flag = $this->model('post')->insert($data);

                if ($flag) {
                    //创建通知
                    $message = array(
                        'sender' => 'system',
                        'receiver' => 'ALL_USER',
                        'content' => '博主有新的文章' . $data['title'],
                        'type' => 'system'
                    );
                    $this->model('notification')->insert($message);
                    echo jet_JSON(array('msg' => '发布成功！', 'has' => true, 'id' => $flag));
                    return;
                } else {
                    echo jet_JSON(array('msg' => '发布失败！', 'has' => false));
                    return;

                }

            } else {
                $category = $this->model('category')->where("type != 'first'")->select();
                $this->assign('category', $category);
                $this->assign('action', 'do_publish');
                $c = array('category' => '');
                $this->assign('post', $c);
                $this->render('admin/post/editor');
            }
        }


        //删除文章
        if ($this->a == 'delete' or $this->a == 'd') {
            $data = array(
                'msg' => false,
            );

            $id = jet_Post('id');
            if (is_numeric($id)) {
                $f = $this->model('post')->where($id)->delete();
                if ($f) {
                    $data['msg'] = true;
                    foreach ($data as $key => $value) {
                        $data[$key] = urlencode($value);
                    }
                    $data = json_encode($data);
                    echo urldecode($data);
                } else {
                    $data['msg'] = false;
                    foreach ($data as $key => $value) {
                        $data[$key] = urlencode($value);
                    }
                    $data = json_encode($data);
                    echo urldecode($data);
                }
            }

        }

        //修改文章
        if ($this->a == 'modify' or $this->a == 'm') {

            $id = jet_Get('id');
            if (is_numeric($id)) {
                if (jet_Post('action') != 'do_modify') {
                    $post = $this->model('post')->where($id)->select();
                    $post[0]['summary'] = strip_tags($post[0]['summary']);
                    $this->assign('post', $post[0]);
                    $this->assign('action', 'do_modify');
                    $category = $this->model('category')->where("type != 'first'")->select();
                    $this->assign('category', $category);
                    $this->render('admin/post/editor');
                } else {
                    $data = jet_Post('post');
                    if ($data['summary'] == false) {
                        $data['summary'] = substr(strip_tags($data['content']), 0, jet_config('summary_length'));
                    }
                    $flag = $this->model('post')->where($id)->update($data);

                    $this->excute($flag, '修改文章', '/admin/post/');
                }


            }
        }
    }

    /**
     * 评论管理
     */
    public function comment()
    {
        //评论列表
        if ($this->a == '' or $this->a == 'index' or $this->a == 'list') {
            $list = $this->model('comment')->select();
            foreach ($list as $key => $value) {
                foreach ($value as $k => $v) {
                    $attach = $list[$key]['attach'];

                    $list[$key]['attach_title'] = $this->model('post')->where($attach)->field('title');

                    if ($k == 'content')     //content字段
                    {
                        $list[$key]['content'] = strip_tags($v);  //去掉html标签v
                    }
                }
            }

            $this->assign('list', $list);
            $this->render('admin/comment/index');
        }
        //删除操作
        if ($this->a == 'd' or $this->a == 'delete') {
            $id = jet_Post('id');
            if (strpos($id, ',')) {
                $flag = $this->model('comment')->delete(trim($id, ','));     //移除前后的字符,
            } else
                $flag = $this->model('comment')->where($id)->delete();
            if ($flag) {
                echo jet_JSON(array('msg' => true));
            } else {
                echo jet_JSON(array('msg' => false));
            }
        }
    }

    public function form_elements()
    {
        $this->render();
    }

    //文件上传
    public function dropzone()
    {
        $this->render();
    }

    //用户登录
    public function login()
    {
        $this->render();
    }

    public function nestable_list()
    {
        $this->render();
    }

    public function tables()
    {
        $this->render();
    }

    public function jqgrid()
    {
        $this->render();
    }

    public function blank()
    {
        $this->render();
    }

    public function calendar()
    {
        $this->render();
    }

    public function widgets()
    {
        $this->render();
    }


}