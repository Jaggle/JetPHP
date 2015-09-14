<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/12
 * Time: 13:04
 */


/**
 * @param $arr
 * @param null $ele
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
function &load_class($class){
    static $_classes = array();

    //�ж����Ƿ����
    if(isset($_classes[$class])){
        return $_classes[$class];
    }
    if(class_exists($class) === false)
    {
        $file = JET.preg_replace('`_+`','/',$class).'.php';
        if(!file_exists($file))
        {
            die("can't find class file for : $file ");
        }
        require_once $file;
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
        echo "第$i个变量为：".$arg_list[$i],PHP_EOL;
    }
    echo "当前文件为：".__FILE__,PHP_EOL;
    if($flag)
    {
        die;
    }
}

/***
 * @param bool|true $flag
 */
function jet_Debug($flag = true)
{
    echo "<strong>COOKie----------------------</strong><br/>";
    dump($_COOKIE);
    echo "<strong>SESSION---------------------</strong><br/>";
    dump($_SESSION);
    echo "<strong>GET---------------------</strong><br/>";
    dump($_GET);

    echo "<strong>POST---------------------</strong><br/>";
    dump($_POST);

    !$flag or die();
}

/**
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
}

/**
 * @param $variable     //是一个数组页可能是一个变量
 * @return array|string 返回具体数据
 */
function jet_Post($variable)
{
    if(isset($_POST[$variable]))
    {
        $p = $_POST[$variable];

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
}

/**
 * jet 系列函数后
 * @param   $s  //全局FILES数组
 * jet_File() 获得$_FILES数组
 */
function jet_Files($s = null)
{
    if($s == null)
    {
        return $_FILES;
    }
    return $_FILES[$s];
}

/**
 * @param $s
 * @return mixed
 */
function jet_config($s)
{
    $config = include(CONFIG . '/common.config.php');
   return $config[$s];
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
