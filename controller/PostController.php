<?php

namespace Jet\Controller;
use Jet\Core\Controller;

class PostController extends Controller
{
    function __call($name, $args)
    {
        die('the method does not exist ');
    }
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $id 需要展示的文章的ID
     *
     */
    public function index($id = null)
    {
        is_numeric($id) or $this->error_404('页面不存在！');
	    $data = $this->model('post')->where($id)->get() or $this->error_404('页面不存在！');
	    $this->assign('title', "夜色空凝");
	    $this->model('post')->where($id)->increase('views','1');        //浏览次数+1
	    $this->assign('id',$id);
	    $this->assign('it',$data);
	    //取得评论
	    $comment = $this->model('comment')->where("(attach = $id and type = 'post')")->select();      //
	    //dump($comment,1);
	    $this->assign('comment',$comment);
	    $this->render();
    }

	/**
	 * 实现ajax添加评论的功能,本方法只用于ajax请求
	 *
	 */
	public function addComment()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' or die('welcome to jet');
		$data = jet_Post('data');
		$data['status'] = 'pending';
		$data['type']   = 'post';                       //评论对应的类型，post为文章
		$data['author'] = $this->current_user();
		$data['content'] = strip_tags($data['content']);
		$in_id = $this->model('comment')->insert($data);     //insert操作
		$data['publish_time'] = $this->model('comment')->where($in_id)->field('publish_time');
		$data['status'] = true;
		if($in_id)
		{
			foreach($data as $key => $value)
			{
				$data[$key] = urlencode($value);
			}
			$data = json_encode($data);
			echo urldecode($data);
		}
		else
			echo "server:failed";
		exit;
	}


    /**
     *
     * @note urlencode只接受字符串变量.
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