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

        //浏览次数+1
        $this->model('site')->where("`key` = 'views'")->increase('value',1) ;

        $this->config = include(CONFIG . '/common.config.php');

        $this->cookie_prefix = $this->config['cookie_prefix'];

        $this->router = include(CONFIG .'/router.config.php');

        $this->assign('front',$this->config['temp_url']);

	    $this->assign('ab_front',ROOT.$this->config['temp_url']);


        $this->assign('router',$this->router);

        //分类
        $category = $this->model('category')->select();
        $this->assign('category',$category);

        //用户类型
        $c_identity = $this->get_cookie('user');
        $c_id = $this->model('user')->where("identity = '$c_identity'")->field('id');
        $u_type = $this->model('user')->where($c_id)->field('type');
        if($u_type)
            $this->assign('u_type',$u_type);
        else
            $this->assign('u_type',false);

        //用户
	    $user = $this->current_user();
        if($user);
		    $this->assign('user',$user);

        //登录状态
        $c_user = $this->current_user();
        $this->assign('status',$this->is_login($c_user));



	  

    }

    /**
     * 模板赋值函数
     * @param $vname
     * @param $varible
     */
    public function assign($vname,$varible){
        global $smarty;
        if(is_array($vname))
        {


            foreach($vname as $key => $value)
            {
                $smarty->assign($key,$value);
            }
        }else
            //dump($vname,1);
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
            $method = str_replace('_','-',$method);
            $ctrl  = substr($trace[1]['class'],0,-10);
            $smarty->display($ctrl.'/'.$method.'.html');


        }else{
            if(strstr($temp,'.html') == false)
            $temp .= '.html';
            $smarty->display($temp);
        }
        exit();//终止后续操作

    }

    /**
     * 该函数同render函数，不做过多说明
     */
    public function display($temp = null){
        self::render($temp);
    }

    /**
     * excute函数
     */
    public function excute($flag,$prefix = '操作',$red = "R:home_page")
    {
        if($flag)
            $this->redirect($prefix."成功！",$red);
        else
            $this->redirect($prefix."失败！",$red);
    }

    /**
     * @param null $model 需要实例化的模型(表)
     * todo 此处需要更好的描述
     * @return mixed
     */
    public function model($model = null){
        //return Jet::model($model);
        return new JET_MODEL($model);
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
     * 用R:来区分正常路径和路由,
     */
    public function redirect($msg,$router,$time = 3)
    {
        $this->assign('msg',$msg);
        $router = trim($router);  //首先去掉前后多余字符
        //路由
        if(strstr($router,':'))
        {

            $router = substr($router,1); //去掉开头的R
            $router = str_replace(':','',$router);//去掉冒号
            $router = trim($router);//再次去掉多余的空格
            $url = $this->router[$router];
        }
        //直接相对网址，相对域名而言
        else
        {
            if(substr($router,0,1) != '/')

                $url = URL.'/'.$router;
            else
                $url = URL.$router;

        }



        $this->assign('url',$url);
        $this->assign('time',$time);
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


        $flag = setcookie($this->cookie_prefix.$name,$value,$expire,$path,$domain);
        //dump($this->cookie_prefix.$name);
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
    public function is_login($user = null)
    {
        if($user == null)
        {
            $identity = $this->get_cookie('user');
            $user = $this->model('user')->where("identity = '".$identity."'")->find('user');
            if($user)
                return true;
            else
                return false;

        }

        $identity = $this->model('user')->where("user = '$user'")->find('identity');

        if($this->get_cookie('user') != $identity)
            return false;
        else
            return true;



        //todo 应该有更好的验证用户当前登录状态的方法，而不是通过session，因为他在关闭浏览器会过期
        /*if($this->get_session($user))
        {
            return true;
        }*/


    }

    /**
     * todo current_user - 应该有很好的获取当前用户的方法
     * 获取当前用户
     */
    public function current_user()
    {
        $identity = $this->get_cookie('user');
        if(!$identity)
            return false;
        $user_name = $this->model('user')->where("identity = '$identity'")->find('user');


        return $user_name;      //比如 admin
    }




}