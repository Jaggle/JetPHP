<?php

class jet{
    public static function start(){
        echo "hello";
        var_dump(self::URL_parse());
    }
    /*
     * ����������URl�������������ͷ����Լ���������
     *
     * @return һ�����飬�������������֣��������֣��Լ���������
     * */
    protected  function URL_parse($url= null){
        $qs = $_SERVER['PHP_SELF'];
        $arr = explode('/',$qs);
        return $arr;
    }
}

 ?>