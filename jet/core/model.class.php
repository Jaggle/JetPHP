<?php

namespace Jet\Core;
use mysqli;

class Model
{
	public $mysqli;     //数据库操作对象
	private $prefix;    //表前缀
	private $sql;
	private $option = array(
		'field' => '',
		'table' => '',
		'where' => '',
		'order' => '',
		'limit' => '',
	);

	/**
	 * 构造函数,当实例化对象时会直接链接需要的表。参数不能为空。
	 * @param string $table 表名，必须。
	 */
	public function __construct($table)
	{
		$db = require(CONFIG . '/db.config.php');
		$this->mysqli = new mysqli($db['host'], $db['user'], $db['pswd'], $db['name']);
		$this->mysqli->set_charset("utf8");
		$this->option['table'] = $db['prefix'].$table;
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
		$row = $result->fetch_row();
		return $row;

	}

	/**
	 * where子句,使支持直接通过系统model获得数据
	 * @param   string  $s  查询条件
	 * @return  object  当前对象
	 */
	public function where($s)
	{
		if(is_numeric($s))
			$this->option['where'] = " where id = $s";
		else
			$this->option['where'] = " where $s ";
		return $this;

	}

	/**
	 * order子句
	 * @param   string  $order 排序条件
	 * @return  object  当前对象
	 */
	public function order($order)
	{
		$this->option['order'] = ' order by '.$order;
		return $this;
	}

	/**
	 * limit子句
	 * @param   string  $limit 限制条件
	 * @return  object
	 *
	 */
	public function limit($limit)
	{
		$this->option['limit'] = ' limit '.$limit;
		return $this;
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
		if ($result) {
			if ($result->num_rows > 0) {
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
	 * 只获取一行记录，返回一个一维数组
	 * @return array|bool
	 */
	public function get()
	{
		$data = $this->select();
		if(is_array($data))
		{
			return $data[0];
		}else
			return false;
	}


	/**
	 * 返回一个字段，并弃用find函数
	 * @param   $f    //需要取得的字段的名称
	 * @return  string|bool
	 */
	public function field($f)
	{
		$data = $this->get();
		if(is_array($data))
		{
			return $data[$f];
		}else
		{
			return false;
		}
	}


	/**
	 * 得到记录的条数
	 */
	public function num()
	{
		$data = $this->select();
		if(is_array($data))
			return sizeof($data);
		else
			return false;
	}


	/**
	 * insert操作,插入一条数据到数据库中
	 * @param $data
	 * @return bool
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
		str_replace('\'','\'\'',$values);   //将一个引号换成两个引号，以方便插入到数据库中
		$sql = "insert into ".$this->option['table']."(".$columns.")"." values "."(".$values.")";
		$this->mysqli->query($sql);
		if($this->mysqli->errno == 0)
			return $this->mysqli->insert_id;
		else
			return false;

	}


	public function setField($field,$value)
	{
		$sql = "update ". $this->option['table']." set  $field = '$value' ".$this->option['where'];
		$this->mysqli->query($sql);
		if($this->mysqli->errno == 0)
			return true;
		else
			return false;
	}

	/**
	 * 更新数据库中的数据
	 *
	 * @param   array
	 * @return  bool
	 */
	public function update($data)
	{
		if(is_array($data))
		{
			$field = '';
			foreach($data as $key => $value)
			{
				$value = str_replace('\'','\'\'',$value);   //将一个引号换成两个引号，以方便插入到数据库中

				$field .= $key."='".$value."', ";
			}
			$field = trim($field);
			$field = substr($field,0,-1); //去掉最后的逗号
			$field = ' ' . $field . ' ';
			$sql = "update ". $this->option['table']." set " . $field.$this->option['where'];
			$result = $this->mysqli->query($sql);
			if($result)
				return true;
			else
				return false;
		}else
			return false;
	}


	/**
	 * @return bool 删除操作，
	 */
	public function delete($where = null)
	{
		if($where != null and strpos($where,','))   //通过id批量删除
		{
			$sql =  "delete from ".$this->option['table']." where id in (".$where.")";
		}else
		{
			$sql = $this->make_sql('d');
		}
		$result = $this->mysqli->query($sql);
		if($result)
			return true;
		else
			return false;
	}

	/**
	 * 字段加1
	 * @return true or false
	 */
	public function increase($field,$num)
	{
		$sql = "update ".$this->option['table']." set $field = $field+$num ".$this->option['where'];
		$this->mysqli->query($sql);
		if($this->mysqli->errno == 0)
			return true;
		else
			return false;

	}

	/**
	 * make_sql()
	 * 创建$sql查询字符串
	 * 参数说明：
	 *      - 默认值 select
	 *      - d delete
	 *      - f find
	 *      - u update
	 *      - i insert
	 *      - s select
	 */
	public function make_sql($a = '')
	{


		//select
		if($a == 's' or $a == '')
		{
			if($this->option['where'] != '')
				$this->sql = "select * from ".$this->option['table'].$this->option['where'];
			else
				$this->sql = "select * from ".$this->option['table'];
			if($this->option['order'] != '')
				$this->sql .= $this->option['order'];
			if($this->option['limit'] != '')
				$this->sql .= $this->option['limit'];
			return $this->sql;

		}

		//delete
		if($a  == 'd')
		{
			if($this->option['where'] != '')
				$this->sql = "delete from ".$this->option['table'].$this->option['where'];
			else
				die('你正在尝试删除表'.$this->option['table'].'中的所有数据，已经被程序阻止');
			return $this->sql;

		}

		//update
		if($a == 'u')
		{
			if($this->option['where'] != '')
				$this->sql = "update ".$this->option['table']." set "." ## ".$this->option['where'];
			else
				die('你正在尝试修改表'.$this->option['table'].'中的所有数据，已经被程序阻止');
			return $this->sql;
		}
	}

}