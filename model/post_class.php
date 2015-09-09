<?php
// +----------------------------------------------------------------------
// | Jakesoft Studio [ Anything can be done by Js will be done by Js. ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.yeskn.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Jake <singviy@qq.com>
// +----------------------------------------------------------------------




class post_class
{

    public function publish(){

        $data = jet_Post('post');

        if($data['summary'] == false)
        {
            $data['summary'] = substr(strip_tags($data['content']),0,jet_config('summary_length'));
        }

        $data['publish_time'] = time();

        $data['author'] = $this->current_user();

        //dump($data);

        $flag = $this->model('post')->insert($data);

        return $flag;

    }

    public function delete(){}

    public function modify(){}

    public function toDraft(){}

    public function get_list(){}

}