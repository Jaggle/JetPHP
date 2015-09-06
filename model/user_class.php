<?php
// +----------------------------------------------------------------------
// | Jakesoft Studio [ Anything can be done by Js will be done by Js. ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.yeskn.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Jake <singviy@qq.com>
// +----------------------------------------------------------------------




class user_class extends JET_MODEL
{
    function __contruct()
    {
        parent::__construct();
    }

    public function get_pswdByUserName($user)
    {
        return $this->get_field('user', 'pswd', 'user', $user);
    }

    /**
     * 通过id获取用户名
     * @param $id
     * @return mixed
     */
    public function get_userNameById($id)
    {
        // user  - 表名
        // user  - 字段名
        // id    - 索引键名
        // $id   - 索引键值
        return $this->get_field('user', 'user', 'id', $id);
    }

    /**
     * 得到识别码
     * @param $user
     * @return string
     */
    public function getIndentifier($user)
    {

        $string = $this->get_field('user','indentifier','user',$user);

        return $string;
    }

}