<?php
/**
 * Created by PhpStorm.
 * User: Jake
 * Date: 2015/8/30
 * Time: 15:41
 */


//namespace Controller\CommonController;

class CommonController
{
    public $router;
    public $config;
    public $cookie_prefix;
    /**
     * 构造函数
     */
    function __construct(){

        require_once(ROOT.'config.php');

        $this->config = $config;
        $this->cookie_prefix = $this->config['cookie_prefix'];
        require_once(ROOT.'router.config.php');

        $this->router = $router;

        $this->assign('front_path',$this->config['temp_path']);
    }

    /**
     * 模板赋值函数
     * @param $vname
     * @param $varible
     */
    public function assign($vname,$varible){
        global $smarty;
        $smarty->assign($vname,$varible);
    }


    /**
     * @param $temp 模板名
     * TODO 如何知道是什么函数调用了当前函数,实现的功能是如果没有指定模板文件，则调用一个以父函数方法命名的模板文件。
     */

    public function render($temp = null){
        global $smarty;
        if($temp == null){
            $trace = debug_backtrace();
            //dump($trace);
            $method = $trace[1]['function'];
            $ctrl  = substr($trace[1]['class'],0,-10);
            $smarty->display($ctrl.'/'.$method.'.html');

        }else{
            $smarty->display($temp);
        }

    }

    /**
     * 该函数同render函数，不做过多说明
     */
    public function display($temp = null){
        self::render($temp);
    }

    /**
     * @param null $model 需要实例化的模型(表)
     * todo 此处需要更好的描述
     * @return mixed
     */
    public function model($model = null){
        return Jet::model($model);
    }

    /**
     * error函数 ,错误提示
     * todo
     */
    public function error($msg,$router)
    {

    }

    /**
     * success函数
     * todo
     */
    public function success()
    {}


    /**
     * redirect函数,普通提示
     * todo
     *
     */
    public function redirect($msg,$router)
    {
        $this->assign('msg',$msg);
        $url = $this->router[$router];
        $this->assign('url',$url);
        $this->render('notice/redirect.html');
        exit();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get_cookie($name)
    {

        return @$_COOKIE[$this->cookie_prefix.$name];
    }

    /**
     * @param $name
     * @param $value
     * @param null $expire 默认为一周的有效时间,
     * @param null $path
     * @param null $domain
     * @return boolean
     */
    public function set_cookie($name,$value,$expire = null,$path = null, $domain = null)
    {

        if($expire == null)
        {
            $expire = time()+3600*24*7;
        }
        if($path == null)
        {
            $path = '/';
        }
        if($domain == null)
        {
            $domain = URL;
        }

        $flag = setcookie($this->cookie_prefix.$name,$value,$expire,$path,$domain);

        return $flag;
    }

    /**
     * 删除cookie
     * @param $name
     * @return int
     */
    public function let_cookie($name)
    {

       if($this->set_cookie($name,'',time()-1))
       {
           return 1;
       }
        else
        {
            return 0;
        }

    }

    /**
     * 创建session
     */
    public function set_session($name,$val)
    {

        if($_SESSION[$name] = $val)
        {
            return true;
        }
        else
        {
            return false;
        }



    }

    /**
     * 获取session
     */
    public function get_session($name)
    {
       if(!@$_SESSION[$name])
           return false;
        else
        {
            return $_SESSION[$name];
        }

    }

    /**
     * 判断用户是否登录
     * @param $user
     * @return bool
     */
    public function is_login($user)
    {
        $user_indentifier = $this->model('user')->getIndentifier($user);
        //dump($user_indentifier);
        if($this->get_cookie('user') != $user_indentifier)
        {

            return false;
        }
        if($this->get_session($user))
        {
            return true;
        }
        else
        {
           // dump($this->get_session($user));
            return false;
        }

    }




}