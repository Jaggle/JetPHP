<?php
/**
 * jet 函数库
 *
 * @author  Jake singviy@qq.com
 * @link    http://www.yeskn.com
 */


/**
 * 去除数组中的某个元素
 *
 * @param   array   $arr
 * @param   null    $ele
 * @return mixed
 */
function array_rid($arr, $ele = null)
{
    foreach ($arr as $k => $v) {
        if ($v == $ele) {
            unset($arr[$k]);
        }
    }
    return $arr;
}

/**
 * @param int $len
 * @return string
 */
function jetRandString($len = 8)
{
    $rand_string = '';
    for ($i = 0; $i < $len; $i++) {
        $rand_string .= chr(mt_rand(97, 122));
    }
    return $rand_string;
}


/**
 * @param $file
 * @return mixed
 */
function get_extension($file)
{
    return end(explode('.', $file));
}

/**
 * @param string $name
 * @param string $type
 * @return bool
 */
function jet_Upload($name = 'random',$type = 'image')
{
    if($type and !file_exists(ROOT.'/uploads/'.$type)){
        mkdir(ROOT.'/uploads/'.$type);
    }
    $f = array_keys($_FILES)[0];
    $ext = get_extension($_FILES[$f]['name']);
    $save_path = $type ? ROOT . '/uploads/'.$type.'/' : ROOT . 'uploads/';
    $save_name = $name ? $name.'.'.$ext : jetRandString(12).'.'.$ext;

    return move_uploaded_file($_FILES[$f]["tmp_name"], $save_path . $save_name) || false;
}

/**
 * @param $var
 * @param int $flag
 */
function dump($var,$flag = 0){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    if($flag)
    {
        die();
    }
}

/**
 * @param $class
 * @return mixed
 */
function &load_class($class)
{
    static $_classes = array();
    if(isset($_classes[$class])){
        return $_classes[$class];
    }
    if(class_exists($class) === false) {
        $file = JET.preg_replace('`_+`','/',$class).'.php';
        if(!file_exists($file)) {
            die("can't find class file for : $file ");
        }
        $_classes[$class] = new $class();
        return $_classes[$class];
    }
}

/**
 * @param bool|false $flag
 */
function debug($flag = false){
    $numargs = func_num_args();
    $arg_list = func_get_args();
    for($i=0;$i<$numargs;$i++)
    {
        echo "第 $i 个变量为：".$arg_list[$i],PHP_EOL;
    }
    echo "当前文件为：".__FILE__,PHP_EOL;
    if($flag)
    {
        die;
    }
}


/**
 * todo jet加密解密函数
 *
 * @param $string
 * @param $key
 */
function jet_Encrypt($string,$key)
{
    $tKey = md5($key);
    $bString = base64_encode($string);
    $salt = 'jet is a cat';


}

/**
 * todo jet加密解密函数
 *
 * @param $string
 * @return mixed
 */
function jet_Decrypt($string)
{
    return $string;
}

/**
 * @param $s
 * @return mixed
 */
function jet_Get($s)
{
    if(isset($_GET[$s]))
        return $_GET[$s];
    else
        return false;
}

/**
 * @param $variable     //是一个数组也可能是一个变量
 * @return array|string 返回具体数据
 */
function jet_Post($variable)
{
    if(isset($_POST[$variable]))
    {
        $p = $_POST[$variable];
        if($p == false)
        {
            return false;
        }

        //字符串
        if(is_string($p))
            $p = trim($p);

        //数组
        else if( is_array($p) )
        {
            foreach($p as $key => $value )
            {
                $p[$key] = trim($value);
            }
        }
        return $p;

    }
    else
        return false;
}

/**
 * jet文件上传函数
 *
 * @param   $var  全局FILES数组
 *
 */
function jet_Files($var = null)
{
    if($var == null)
    {
        return $_FILES;
    }
    return $_FILES[$var];
}

/**
 * 默认加载配置文件common.config.php中的配置 返回一个字符串
 * 如果在common.config.php中加载不到该配置项，则在config目录早查找以var开头的配置文件,并返回一个数组
 * todo 也可以使用 a:b的方式加载a文件中的配置b
 *
 * @param $var
 * @return mixed
 */
function jet_Config($var)
{
    $config = include(CONFIG . '/common.config.php');
    if(isset($config[$var]))
    {
        return $config[$var];
    }
    else
    {
        if(file_exists(CONFIG . "/$var.config.php"))
        {
            return require(CONFIG . "/$var.config.php");
        }
        else
        {
            return false;
        }
    }
}

/**
 * @param $name
 * @param null $value
 * @param null $expire
 * @param null $path
 * @param null $domain
 * @return mixed
 */
function jet_cookie($name,$value = null,$expire = null,$path = null, $domain = null)
{
    //判断前缀
    if(strpos($name,jet_config('cookie_prefix')) == false)
    {
        $name = jet_config('cookie_prefix').$name;
    }

    //设置cookie
    if($expire > 0)
    {
        setcookie($name,$value,$expire,$path,$domain);
    }

    //获得cookie
    else
    {

        return $_COOKIE[$name];

    }
}

/**
 * 重写JSON_encode函数
 *
 * @param   mixed  $var 只接受一维数组和字符串
 * @return  mixed
 */
function jet_JSON( $var)
{
    if(is_array($var)) {
        foreach($var as $key => $value)
        {
            $var[$key] = str_replace('"','\'',urlencode($value));       //替换双引号
	        $var[$key] = str_replace(':','|=|',$var[$key]);             //替换冒号
        }
        $var = json_encode($var);
        return urldecode($var);
    }
	//字符串
	else if(is_string($var)) {
		return 	urldecode(json_encode(urlencode($var)));
	}
    else{
        return false;
    }
}

/**
 * 多语言支持
 * 虽然目前没有多语言支持，但是我还是需要为它做准备
 * @param   string  $string 需要翻译的字符串
 * @return  string  返回翻译过的字符串或者不做翻译
 */
function jet_Lang($string)
{
    return $string;
}


/*  其他非jet系列函数 */

/**
 * 将arr中的元素作为配置加载给对象obj
 *
 * @param object $obj
 * @param string $arr
 */

function apply_config($obj,$arr)
{
    $arr = require(CONFIG."/$arr.config.php");
    foreach($arr as $key => $value)
    {
        $obj->$key = $value;
    }

}

