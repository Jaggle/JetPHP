<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/12
 * Time: 13:04
 */
 /*
  * 去除数组元素的空值，默认去除空字符串
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
