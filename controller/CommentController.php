<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/14
 * Time: 15:50
 */

class CommentController extends  CommonController
{
	//���µ�����
	public function post()
	{
		$id = jet_Get('id');
		if( ! $id)
			$this->redirect('','R:home_page',0);




		$data = jet_Post('comment');
		$data['attach'] = $id;
		$data['status'] = 'pending';
		$data['type']   = 'post';
		$data['author'] = $this->current_user();

		$data['content'] = strip_tags(jet_Post('content'));

		$in_id = $this->model('comment')->insert($data);     //insert操作

		//todo 应该有更好的发布时间

		$data['publish_time'] = $this->model('comment')->where($in_id)->field('publish_time');

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
	}
}