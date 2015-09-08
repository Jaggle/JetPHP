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

        $this->assign('title', "Jetstar首页");
        $user = $this->current_user();
        $c_user = $this->current_user();
        $this->assign('status',$this->is_login($c_user));
        $this->assign('user',$user);


        //文章列表
        $post_list = $this->model('post')->order('publish_time ASC')->select();

        $this->assign('posts',$post_list);

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
}