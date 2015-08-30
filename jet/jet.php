<?php
require_once(JET.'common/functions.php');

class jet{
    public static function start()
    {

        $route = self::URL_parse();
        $route['contrl'] = @trim(ucfirst($route[0])) ? @trim(ucfirst($route[0])) : "index";
        $route['method'] = @trim($route[1]) ? @trim($route[1]) : 'index';
        if (file_exists(CTL . $route['contrl']) . 'Controller.php') {
            $ctlName = $route['contrl'] . 'Controller';
            $contrl = new $ctlName;
            if (method_exists($contrl, $route['method'])) {

                $contrl->$route['method']();
            } else {
                die('方法不存在');
            }
        } else {
            die('控制器不存在');
        }
    }
    /*
     *
     *
     * @return
     * */
    protected  function URL_parse($url= null)
    {
        $query_string = $_SERVER['QUERY_STRING'];
        $php_self = $_SERVER['PHP_SELF'];
        $arr = explode('/', $php_self);
        $arr = array_rid($arr, $ele = '');
        unset($arr[1]);
        $arr = array_values($arr);
        return $arr;
    }



}

 ?>