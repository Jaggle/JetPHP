<?php

namespace Jet\Controller;
use Jet\Core\Controller;

class CategoryController extends Controller
{
    public function index($id)
    {
        $c_name = $this->model('category')->where($id)->field('name');
        $list = $this->model('post')->where("category = '$c_name'")->select();
        $this->assign('list',$list);
        $this->assign('cate_name',$c_name);
        $this->render();
    }
}