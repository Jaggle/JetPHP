<?php
// +----------------------------------------------------------------------
// | Jakesoft Studio [ Anything can be done by Js will be done by Js. ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.yeskn.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Jake <singviy@qq.com>
// +----------------------------------------------------------------------




class post_class extends JET_MODEL
{
    public function get_post_by_id($id)
    {

        return  $this->get_row('post', $id);
    }

    public function get_post_list($category_id,$page,$per_page,$order_by,$pub_time)
    {
        $where = array();

        if($category_id)
        {
            $where[] = 'category_id = '.intval($category_id);
        }

        if($pub_time)
        {
            $where[] = 'pub_time >' . (time() - $pub_time*24*60*60);
        }

        return $this->get_page('post','',$order_by , $page , $per_page);

    }
}