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
        $posts = $this->model('post')->order('publish_time DESC')->select();

        foreach($posts as $key =>$value)
        {
            foreach($value as $k => $v)
            {
                $posts[$key]['summary'] = strip_tags($posts[$key]['summary']);
                $posts[$key]['content'] = strip_tags($posts[$key]['content']);
            }
        }


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


}