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

    private $_db;

    private $option = array(
        'field' => '',
        'table' => '',
        'where' => '',
        'order' => '',
        'limit' => '',
    );

    private $sql;

    /**
     * 构造函数
     *
     */
    public function __construct($table)
    {
        $this->_db = require(JET.'/config/db.php');
        $db = $this->_db;
        $this->mysqli = new mysqli($db['host'], $db['user'], $db['pswd'], $db['name']);
        $this->mysqli->set_charset("utf8");
        $this->option['table'] = $table;
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
        return $this->get_prefix() . $name;
    }


    /**
     * 查询一行数据，返回数组
     */
    public function get_row($table, $id)
    {


        $query = "select * from $table where  id= $id";
        $result = $this->mysqli->query($query);
        //debug();
        $row = $result->fetch_row();
        return $row;

    }

    /**
     * 查询一个字段，返回string
     */
//    public function get_field($table,$field,$key,$val)
//    {
//        $query = "SELECT $field FROM $table where $key = '".$val."'";
//
//        $result = $this->mysqli->query($query);
//        //dump($query,0);
//
//        if ($result)
//        {
//            if($result->num_rows>0)
//            {
//                while($row =$result->fetch_array() ){                        //循环输出结果集中的记录
//                    $v = $row[0];
//                    //dump($v);
//                    return $v;
//
//                }
//            }
//        }
//
//
//    }

    public function get_page($table, $where = null, $order = null, $page = null, $limit = 10)
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
        $v = array();
        if ($result) {
            if ($result->num_rows > 0) {
                //一个row就是一行记录
                while ($row = $result->fetch_array()) {
                    $v[] = $row;
                }
            }
        }

        //dump($this->mysqli);
        $start_row = ($page - 1) * $limit + 1;

        $v = array_slice($v, $start_row, $limit);

        return $v;
    }

    /**
     * where子句
     * 使支持直接通过系统model获得数据
     */
    public function where($s)
    {
        $this->option['where'] = $s;
        return $this;

    }

    /**
     * order子句
     */
    public function order($order)
    {
        $this->option['order'] = $order;
        return $this;
    }

    /**
     * limit子句
     *
     */
    public function limit($limit)
    {
        $this->option['limit'] = $limit;
        return $this;
    }

    /**
     * find 子句
     * find子句之后不应该有其他子句
     * find子句用于返回符合查询结果的一个字段，
     * @return string;
     */
    public function find($field)
    {
        $sql = $this->make_sql();
        $result = $this->mysqli->query($sql);
        $r =array();
        if ($result) {
            if ($result->num_rows > 0) {
                //一个row就是一行记录
                while ($row = $result->fetch_array()) {
                    return $row[$field];
                }

            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * select子句
     * select子句之后不应该有其他子句
     * @return array 一个二元数组
     */
    public function select()
    {
        $sql = $this->make_sql();
        $result = $this->mysqli->query($sql);
        $r =array();

        //dump($result->fetch_array());die;
        if ($result) {
            if ($result->num_rows > 0) {
                //一个row就是一行记录
                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  array_push($r,$row);
                }
                return $r;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
    /**
     * insert操作,插入一条数据到数据库中
     */
    public function insert($data)
    {
        $columns = array_keys($data);

        $columns = implode(',',$columns);

        foreach($data as  $key =>$v)
        {
            $data[$key] = "'".$v."'";
        }

        $values =  implode(',',$data);

        $sql = "insert into ".$this->option['table']."(".$columns.")"." values "."(".$values.")";



        $result = $this->mysqli->query($sql);



        if($this->mysqli->errno == 0)
            return true;
        else
            return false;

    }

    /**
     * update子句
     */
    public function update()
    {

    }

    /**
     * 字段加1
     * @return true or false
     */
    public function increase($field)
    {
        $sql = "update $this->option['table'] set '$field' = '$field'+1 ";

        $this->mysqli->query($sql);

        if($this->mysqli->errno == 0)
            return true;
        else
            return false;

    }

    /**
     * make_sql()
     * 创建$sql查询字符串
     */
    public function make_sql()
    {
        if(empty($this->option['field']))
        {
            $this->sql = "SELECT * ";
        }
        else
        {
            $this->sql = "select ".$this->option['field'];
        }
        if(empty($this->option['table']))
        {
            die('没有选择数据表');
        }
        else
        {
            $this->sql .= ' from '.$this->option['table'];
        }
        if(!empty($this->option['where']))
        {
            $this->sql .= ' where '.$this->option['where'];
        }
        if(!empty($this->option['order']))
        {
            $this->sql .= ' order by '.$this->option['order'];
        }
        if(!empty($this->option['limit']))
        {
            $this->sql .= ' limit '.$this->option['limit'];
        }

        return $this->sql;


    }
























}