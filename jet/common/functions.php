<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/12
 * Time: 13:04
 */
 /*
  * ȥ������Ԫ�صĿ�ֵ��Ĭ��ȥ�����ַ���
  *
  * */
 function array_rid($arr,$ele=null){
    foreach($arr as $k => $v){
        if($v == $ele){
          unset($arr[$k]);
        }
    }
    return $arr;
 }
