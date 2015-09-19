<?php
//路由配置文件,使用此路由需要在前面添加R:,比如R:home_page
//生成的都是绝对路由
return [
    'home_page'     => URL,
    'login'         => URL . '/account/login',
    'post'          => URL . '/post',
    'admin'         => URL . '/admin',
    'publish_post'  => URL . '/admin/index?p=post&a=publish',
];