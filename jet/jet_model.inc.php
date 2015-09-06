<?php
// +----------------------------------------------------------------------
// | Jakesoft Studio [ Anything can be done by Js will be done by Js. ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.yeskn.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Jake <singviy@qq.com>
// +----------------------------------------------------------------------


class JET_MODEL
{
    public $prefix;
    public $setting;
    public $mysqli;
    private $_current_db = 'master';
    private $_shutdown_query = array();
    private $_found_rows =0;

    /**
     * 构造函数
     *
     */
    public function __construct(){


        $this->mysqli = new mysqli('localhost','root','','test');
        //$r= $this->mysqli->query('select * from user');
        //dump($this->mysqli,0);
        //echo "________________________________________________________________________________";
        $this->mysqli->set_charset("utf8");


    }

    public function model($model)
    {
        return Jet::model($model);
    }

    /**
     * 获取表前缀
     */
    public function get_prefix()
    {
        return $this->prefix;
    }

    /**
     * 获取表名
     *
     * 直接写sql的时候需要用到这个函数，外部程序使用get_table方法
     * @access public
     * @param string
     * @return string
     */
    public function get_table($name)
    {
        return $this->get_prefix().$name;
    }

    /**
     * 选取数据库
     */
    public function select()
    {
        return $this->db()->select();
    }

    /**
     * 查询一行数据，返回数组
     */
    public function get_row($table,$id)
    {


        $query="select * from $table where  id= $id";
        $result = $this->mysqli->query($query);
        //debug();
        $row = $result->fetch_row();
        return $row;

    }

    /**
     * 查询一个字段，返回string
     */
    public function get_field($table,$field,$key,$val)
    {
        $query = "SELECT $field FROM $table where $key = '".$val."'";

        $result = $this->mysqli->query($query);
        //dump($query,0);

        if ($result)
        {
            if($result->num_rows>0)
            {
                while($row =$result->fetch_array() ){                        //循环输出结果集中的记录
                    $v = $row[0];
                    //dump($v);
                    return $v;

                }
            }
        }


    }

    public function get_page($table,$where = null,$order = null , $page = null,$limit = 10)
    {
        if (!$page) {
            $page = 1;
        }

        if ($where) {
            $where .= 'WHERE ';
        } else {
            $where = '';
        }

        if ($order) {
            $order .= ' ORDER BY ';
        } else {
            $order = '';
        }
        //首先获得除了page之外的所有结果集
        $query = "SELECT * FROM $table";
        $result = $this->mysqli->query($query);
        $v =array();
        if ($result) {
            if ($result->num_rows > 0) {
                //一个row就是一行记录
                while ($row = $result->fetch_array()) {
                    $v[] = $row;
                }
            }
        }

        //dump($this->mysqli);
        $start_row = ($page-1) * $limit + 1;

        $v = array_slice($v, $start_row, $limit);

        return $v;


    }























}