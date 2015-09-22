<?php

use Jet\Core;
use Jet\Controller;

class jet
{
    private static $models = array();
    public static function start()
    {

        $route = self::URL_parse();
        $route['control'] = @trim(ucfirst($route[0])) ? @trim(ucfirst($route[0])) : "index";
	    $route[0] = $route['control'];
        $route['method'] = @trim($route[1]) ? @trim($route[1]) : 'index';
	    $route[1] = $route['method'];
        $flag = strstr($route['method'],'.html') || strstr($route['method'],'.htm') || strstr($route['method'],'.php');
        $flag2 = $flag || strstr($route['method'],'.jsp');

	    //去掉后缀
        if($flag2)
        {
            $pattern = '/(.*?)\.(.*?)/';
            preg_match($pattern,$route['method'],$match);
            $route['method'] = $match[1];
        }
        $route['method'] = str_replace('-','_',$route['method']);
		//dump($route,1);
	    //是否转入agent
	    if($route[0] == 'Agent' && !empty($route[1]) )        //代理模式
	    {

		    if(file_exists(JET.'/agent/'.$route[1].'Agent.php'))
		    {
			    $agent_space = 'Jet\\Agent\\'.$route[1]."Agent";
				$agent = new $agent_space();
			    return $agent->$route[2]();
		    }
		    else
		    {
			    throw new Whoops\Exception\ErrorException('不存在该代理');
		    }
	    }

        if (file_exists(CTL .'/'. $route['control'] . 'Controller.php'))
        {
	        $control_space = 'Jet\\Controller\\'.$route[0].'Controller';
            $control = new $control_space;

            //第二个参数为数字的情况
            if(is_numeric($route['method'])){
                //调用index方法并且得到id
                $control->index($route['method']);
                return 0;
            }
            //dump($route);
            if (method_exists($control, $route['method']))
            {
				//判断更多参数的情况
                if(isset($route[2]))
                {
	                $control->$route['method']($route[2]);
                }
	            elseif(isset($route[3]))
	            {
		            $control->$route['method']($route[2],$route[3]);
	            }
	            else
		            $control->$route['method']();
            }

            else
            {
	            $control->index($route['method']);            //将路由数据传给index
            }
        }
        else
        {
	        $control = new Jet\Core\Controller;       //渲染404页面
            $control->error_404('控制器不存在');
        }
    }

    /**
     *解析当前的url链接
     *
     * @return mixed
     */
    protected  static function URL_parse()
    {
        $php_self = $_SERVER['PHP_SELF'];
        $arr = explode('/', $php_self);
        $arr = array_rid($arr, $ele = '');
        unset($arr[1]);
        $arr = array_values($arr);
        return $arr;
    }

    /**
     * 调用系统 Model
     * 根据命名规则调用相应的Mdel并初始化类库保存于 self::$models数组，防止重复初始化
     * @param null $model_class
     * @return mixed
     */
    public static function model($model_class = null)
    {
        if(!$model_class)
        {
            $model_class = 'JET_MODEL';
        }
        //不存在_class后缀就自动加上去
        else if(! strstr($model_class,'_class'))
        {
            $model_class .= '_class';
        }
        if(!isset(self::$models['model_class']))
        {
            self::$models[$model_class] = new $model_class();
        }
        return self::$models[$model_class];
    }


}
