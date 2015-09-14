<?php



class jet
{
    private static $config;//这tm是一个对象,我不说你萌知道么？
    private static $models = array();
    public static function start()
    {

        $route = self::URL_parse();
        $route['contrl'] = @trim(ucfirst($route[0])) ? @trim(ucfirst($route[0])) : "index";
        $route['method'] = @trim($route[1]) ? @trim($route[1]) : 'index';
        if(strstr($route['method'],'.html') or strstr($route['method'],'.htm'))
        {   $m =  $route['method'];
            $tm = '';
            for($i=0;$i<strlen($m);$i++)
            {
                if(substr($m,$i,1) != '.')
                {
                    $tm = substr($m,0,$i+1);
                }
                else
                {
                    break;
                }
            }
            $route['method'] = $tm;
        }
        $route['method'] = str_replace('-','_',$route['method']);


        if (file_exists(CTL .'/'. $route['contrl'] . 'Controller.php'))
        {
            $ctlName = $route['contrl'] . 'Controller';
            $contrl = new $ctlName;

            //第二个参数为数字的情况
            if(is_numeric($route['method'])){
                //调用index方法并且得到id
                $contrl->index($route['method']);
                //$contrl->test();
                return;
            }
            //dump($route);
            if (method_exists($contrl, $route['method']))
            {
				//判断更多参数的情况
                if(isset($route[2]))
                {
	                $contrl->$route['method']($route[2]);
                }
	            elseif(isset($route[3]))
	            {
		            $contrl->$route['method']($route[2],$route[3]);
	            }
	            else
		            $contrl->$route['method']();
            }
            //存在控制器文件但是不存在控制器的方法,那么将方法当作参数传给控制器的index方法
            else
            {

	            $contrl->index($route['method']);
            }
        }
        else
        {
	        $contrl = new CommonController();       //渲染404页面
            $contrl->error_404();
        }
    }
    /*
     *
     *
     * @return
     * */
    protected  static function URL_parse($url= null)
    {
        $query_string = $_SERVER['QUERY_STRING'];
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

    /**
     * 系统初始化
     */
    private static function init(){
        self::$config = load_class('core_config');
    }

    /**
     * 获取系统配置
     * 调用core/config.php
     * @access public
     * @return object
     */
    public static function config(){
        return self::$config;
    }


}
