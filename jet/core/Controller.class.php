<?php

/**
 * Class Controller
 * 公用控制器，中间件
 * fixme 已经将common控制器移出来放在核心文件夹下面，或许需要优化
 * @author  Jake singviy@qq.com
 * @link    http://www.yeskn.com
 */

namespace Jet\Core;

class Controller extends Jet
{
    public $router;
    public $config;
    public $cookie_prefix;

    function __construct()
    {
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

        //接收系统通知
        $noti = $this->model('notification')->where("is_read = 0 and type = 'system'")->select();
        if(!$noti)
            $notiNum = 0;
        else
            $notiNum = count($noti);
        $this->assign('noti',$noti);

        $this->assign('notiNum',$notiNum);

	  

    }

    /**
     * 模板赋值函数 收集模板的变量
     * fixme 应该拥有更高的抽象，使程序能被多个模板引擎使用
     *
     * @param   mixed   $name   name如果为数组，将在模板中以key = value的方式赋值,并忽略val的值
     *                          否则直接name = val
     * @param   string  $value
     */
    public function assign($name,$value)
    {
        global $TE,$TEPARAM;
        if(is_array($name)) {
            foreach($name as $key => $value) {
                switch(jet_Config('template_engine')){
                    case 'twig' :
                        $TEPARAM[$key] = $value;
                        break;
                    case 'smarty' :
                        $TE->assign($key,$value);
                }
            }
        }else
            switch(jet_Config('template_engine')){
                case 'twig' :

                    $TEPARAM[$name] = $value;
                    break;
                case 'smarty' :
                    $TE->assign($name,$value);
            }
    }


    /**
     * 模板渲染函数，重写smarty的display函数
     *
     * @param $temp string  模板名
     * FIXME 如何知道是什么函数调用了当前函数,实现的功能是如果没有指定模板文件，则调用一个以父函数方法命名的模板文件。
     */

    public function render($temp = null)
    {
        global $TE,$TEPARAM;
        if($temp == null)
        {
            $trace = debug_backtrace();
            $method = $trace[1]['function'];
            $method = str_replace('_','-',$method);
            $ctrl  = substr($trace[1]['class'],0,-10);
            $ctrl  = substr($ctrl,15);
            switch(jet_Config('template_engine')){
                case 'twig':
                    echo $TE->render($ctrl.'/'.$method.'.html.twig',$TEPARAM);
                    break;
                case 'smarty' :
                    $TE->display($ctrl.'/'.$method.'.html');
            }

        }
        else
        {
            strstr($temp,'.html') == false && $temp .= '.html';
            switch(jet_Config('template_engine')){
                case 'twig':
                    echo $TE->render($temp.'.twig',$TEPARAM);
                    //die('dd');
                    break;
                case 'smarty' :
                    $TE->display($temp);
		            break;

            }

        }
	    exit;
    }

    /**
     * render函数的同名函数
     * @param   string  $temp   模板名字
     */
    public function display($temp = null)
    {
        self::render($temp);
    }

    /**
     * 判断flag，如果为true,则执行成功，否则执行失败，这是redirect判断的简化函数
     *
     * @param $flag
     * @param string $prefix
     * @param string $red
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
     *
     * @return object
     */
    public function model($model = null)
    {
        return new Model($model);
    }


    /**
     * redirect函数,普通提示
     * todo
     * 用R:来区分正常路径和路由,
     * @param $msg
     * @param $router
     * @param int $time
     */

    public function redirect($msg,$router,$time = 2)
    {
	    $url = $this->get_url($router);
	    if($time == 0) {
		    header("Location:$url");
	    }
        $this->assign('msg',$msg);
        $this->assign('url',$url);
        $this->assign('time',$time);
        $this->render('notice/redirect.html');
        exit();
    }

    /**
     * 刷新当前页面
     *
     * @param string $msg 提示消息
     * @param int $time 需要等待的时间，默认2秒
     */
    public function refresh($msg,$time = 2)
    {
	    $this->assign('url',URL.'/'.$_SERVER['REQUEST_URI']);
	    $this->assign('msg',$msg);
	    $this->assign('time',$time);
	    $this->render('notice/redirect.html');

    }

    /**
     * 获取cookie
     * fixme 该函数与jet_cookie功能一样，后续版本可能会只保留一个cookie存取方案
     *
     * @param string $name
     * @return mixed
     */
    public function get_cookie($name)
    {
        return @$_COOKIE[$this->cookie_prefix.$name];
    }

    /**
     * 创建cookie
     * fixme 该函数与jet_cookie功能一样，后续版本可能会只保留一个cookie存取方案
     *
     * @param string $name
     * @param string $value
     * @param null $expire 默认为一周的有效时间,
     * @param null $path
     * @param null $domain
     * @return boolean
     */
    public function set_cookie($name,$value,$expire = null,$path = null, $domain = null)
    {
        if($expire == null) {
            $expire = time()+3600*24*7;
        }
        if($path == null) {
            $path = '/';
        }
        $flag = setcookie($this->cookie_prefix.$name,$value,$expire,$path,$domain);
        return $flag;
    }

    /**
     * 删除cookie
     * fixme 该函数与jet_cookie功能一样，后续版本可能会只保留一个cookie存取方案
     *
     * @param string $name
     * @return int
     */
    public function let_cookie($name)
    {
       if($this->set_cookie($name,'',time()-1)) {
           return 1;
       }else{
            return 0;
        }
    }

    /**
     * 创建session
     * fixme 该函数与jet_session功能一样，后续版本可能会只保留一个cookie存取方案
     *
     * @param   string $name  session的名称
     * @param   string $val   session的值
     * @return  bool
     */
    public function set_session($name,$val)
    {
        if($_SESSION[$name] = $val) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取session
     * fixme 该函数与jet_session功能一样，后续版本可能会只保留一个cookie存取方案
     *
     * @param   string $name
     * @return  mixed
     */
    public function get_session($name)
    {
       if(!@$_SESSION[$name])
           return false;
        else
            return $_SESSION[$name];
    }

    /**
     * 判断用户是否登录
     * todo 应该有更好的验证用户当前登录状态的方法，而不是通过session，因为他在关闭浏览器会过期
     *
     * @param $user
     * @return bool
     */
    public function is_login($user = null)
    {
        if($user == null) {
            $identity = $this->get_cookie('user');
            $flag = $this->model('user')->where("identity = '".$identity."'")->num();
            if($flag)
                return true;
            else
                return false;
        }

        $identity = $this->model('user')->where("user = '$user'")->field('identity');
        if($this->get_cookie('user') != $identity)
            return false;
        else
            return true;
    }

    /**
     * todo current_user - 应该有很好的获取当前用户的方法
     *
     * 获取当前用户的name
     */
    public function current_user()
    {
        $identity = $this->get_cookie('user');
        if(!$identity)
            return false;
        $user_name = $this->model('user')->where("identity = '$identity'")->field('user');
        return $user_name;
    }

    /**
     * 在控制器中经常会用到url,本函数将字符串处理成程序可以识别的链接
     *
     * @param   string  $route 如果包含R:，说明这是一个路由，做另外处理，否则直接返回以[URL]为域名的url地址
     * @return  string
     */
	public function get_url($route)
	{
		$router = trim($route);  //首先去掉前后多余字符
		//路由
		if(strstr($router,'R:'))
		{
			$router = substr($router,1); //去掉开头的R
			$router = str_replace(':','',$router);//去掉冒号
			$router = trim($router);//再次去掉多余的空格
			$url = $this->router[$router];
		}
		else
		{//直接相对网址，相对域名而言
			if(substr($router,0,1) != '/')
				$url = URL.'/'.$router;
			else
				$url = URL.$router;
		}
		return $url;
	}

    /**
     * 跳转到404页面
     *
     * @param string $msg 页面提示内容
     */

	public function error_404($msg = '该页面不存在！')
	{
		$this->assign('msg',jet_Lang($msg));
		$this->render('notice/404');
	}




}