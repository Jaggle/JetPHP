<?php

class jet{
    public static function start(){
        echo "hello";
        var_dump(self::URL_parse());
    }
    /*
     * 根据完整的URl解析出控制器和方法以及其他参数
     *
     * @return 一个数组，包括控制器名字，方法名字，以及其他参数
     * */
    protected  function URL_parse($url= null){
        $qs = $_SERVER['PHP_SELF'];
        $arr = explode('/',$qs);
        return $arr;
    }
}

 ?>