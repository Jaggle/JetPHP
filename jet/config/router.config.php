<?php
//配置所有的路由，用于快速生成url,使用时请前面加上[R:]
return [
    'home_page' => URL,
    'login'     => URL.'/account/login',
    'post'      => '/post',
    'admin'     => '/admin',
    'publish_post' => '/admin/index?p=post&a=publish',
];