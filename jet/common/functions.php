<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/12
 * Time: 13:04
 */


/**
 * ȥ������Ԫ�صĿ�ֵ��Ĭ��ȥ�����ַ���
 *
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

/*
 * ��������ַ���
 * */
function jetRandString($len = 8)
{
    $rand_string = '';
    for ($i = 0; $i < $len; $i++) {
        $rand_string .= chr(mt_rand(97, 122));
    }
    return $rand_string;
}


/*
 * ��ȡ�ļ��ĺ�׺
 * */
function get_extension($file)
{
    return end(explode('.', $file));
}

/*
 * �ϴ������ļ�
 * */
function jetUpload($name = 'random',$type = 'image')
{
    if($type and !file_exists(ROOT.'uploads/'.$type)){
        mkdir(ROOT.'uploads/'.$type);
    }
    $f = array_keys($_FILES)[0];
    $ext = get_extension($_FILES[$f]['name']); //�ļ���׺
    $save_path = $type ? ROOT . 'uploads/'.$type.'/' : ROOT . 'uploads/';
    $save_name = $name ? $name.'.'.$ext : jetRandString(12).'.'.$ext;

    return move_uploaded_file($_FILES[$f]["tmp_name"], $save_path . $save_name) || false;
}

/**
 * ��дvar_dump����
 * �����޸�����Ϊdump����
 *
 */
function dump($var,$flag = 1){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    if($flag)
    {
        die();
    }
}

/**
 * ������⣬��ʵ�������������
 * ·����jet��ʼ�㣬����ѭ Zend Freamework ·����ʾ�������»��� _ ȡ�� / , �� core_config ��ʾ jet/core/config.php
 *
 * @param string
 * @return object
 * @note ��������ʹ�����µķֽڷ� ��
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
 * debug
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

/**
 * jet系列函数 之 原创加密函数
 * string - 需要加密的函数
 * $key   - 加密码，可以保存在config配置文件当中，或者自定义一个key
 */
function jet_Encrypt($string,$key)
{
    $tKey = md5($key);
    $bString = base64_encode($string);
    $salt = 'jet is a cat';


}

/**
 * jet系列函数 之 原创解密函数
 */
function jet_Decrypt($string)
{


    return $string;
}

/**
 * jet系列函数
 * jet_get() 得到整个$_GET[]数组
 * s string 需要取得的元素的键名
 */
function jet_Get($s)
{
    return $_GET[$s];
}

/**
 * jet 系列函数
 * jet_Post() 得到post值
 * s string 需要取得的元素的键名
 */
function jet_Post($s)
{
    return $_POST[$s];
}

/**
 * jet 系列函数后
 * jet_File() 获得$_FILES数组
 */
function jet_Files($s)
{
    return $_FILES[$s];
}

/**
 * jet 系列函数
 * jet_config($s)
 * 获得一个config
 */
function jet_config($s)
{
    $config =  include(CONFIG_PATH.'config.php');
   return $config[$s];
}

/**
 * jet 系列函数
 * jet_cookie 设置或者取得cookie值
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
