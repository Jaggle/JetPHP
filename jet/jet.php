<?php



class jet
{
    private static $models = array();
    public static function start()
    {

        $route = self::URL_parse();
        $route['control'] = @trim(ucfirst($route[0])) ? @trim(ucfirst($route[0])) : "index";
        $route['method'] = @trim($route[1]) ? @trim($route[1]) : 'index';
        $flag = strstr($route['method'],'.html') || strstr($route['method'],'.htm') || strstr($route['method'],'.php');
        $flag2 = $flag || strstr($route['method'],'.jsp');
        if($flag2)
        {
            $pattern = '/(.*?)\.(.*?)/';
            preg_match($pattern,$route['method'],$match);
            $route['method'] = $match[1];
        }
        $route['method'] = str_replace('-','_',$route['method']);

        if (file_exists(CTL .'/'. $route['control'] . 'Controller.php'))
        {
            $ctlName = $route['control'] . 'Controller';
            $control = new $ctlName;

            //第二个参数为数字的情况
            if(is_numeric($route['method'])){
                //调用index方法并且得到id
                $control->index($route['method']);
                return;
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
            //存在控制器文件但是不存在控制器的方法,那么将方法当作参数传给控制器的index方法
            else
            {
                dump($route,1);
                $control = new CommonController();       //渲染404页面
                $control->error_404('此方法不存在');
            }
        }
        else
        {
	        $control = new CommonController();       //渲染404页面
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
