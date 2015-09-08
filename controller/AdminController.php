<?php


class AdminController extends CommonController
{

    function __call($name, $args)
    {
        die('指定的方法不存在');

    }

    //构造函数
    function __construct(){
        parent::__construct();
        if($this->is_login() == false){
            $this->redirect('请先登录','home_page');
        }
    }

    public function index()
    {
        $this->render('');
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
    public function error_404()
    {
        $this->render('admin/error-404');
    }
    public function publish()
    {
        $this->render();
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





}