<?php


namespace Jet\Controller;
use Jet\Core\Controller;

class MemberController extends Controller
{
    public function  index(){
        $this->display('member/index.html');
    }
}