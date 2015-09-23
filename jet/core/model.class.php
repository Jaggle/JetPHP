<?php

namespace Jet\Core;
use mysqli;

class Model
{
	public $mysqli;     //���ݿ��������
	private $prefix;    //��ǰ׺
	private $sql;
	private $option = array(
		'field' => '',
		'table' => '',
		'where' => '',
		'order' => '',
		'limit' => '',
	);

	/**
	 * ���캯��,��ʵ��������ʱ��ֱ��������Ҫ�ı���������Ϊ�ա�
	 * @param string $table ���������롣
	 */
	public function __construct($table)
	{
		$db = require(CONFIG . '/db.config.php');
		$this->mysqli = new mysqli($db['host'], $db['user'], $db['pswd'], $db['name']);
		$this->mysqli->set_charset("utf8");
		$this->option['table'] = $db['prefix'].$table;
	}


	/**
	 * ��ȡ��ǰ׺
	 */
	public function get_prefix()
	{
		return $this->prefix;
	}

	/**
	 * ��ȡ����
	 *
	 * ֱ��дsql��ʱ����Ҫ�õ�����������ⲿ����ʹ��get_table����
	 * @access public
	 * @param string
	 * @return string
	 */
	public function get_table($name)
	{
		return $this->get_prefix() . $name;
	}


	/**
	 * ��ѯһ�����ݣ���������
	 */
	public function get_row($table, $id)
	{
		$query = "select * from $table where  id= $id";
		$result = $this->mysqli->query($query);
		$row = $result->fetch_row();
		return $row;

	}

	/**
	 * where�Ӿ�,ʹ֧��ֱ��ͨ��ϵͳmodel�������
	 * @param   string  $s  ��ѯ����
	 * @return  object  ��ǰ����
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
	 * order�Ӿ�
	 * @param   string  $order ��������
	 * @return  object  ��ǰ����
	 */
	public function order($order)
	{
		$this->option['order'] = ' order by '.$order;
		return $this;
	}

	/**
	 * limit�Ӿ�
	 * @param   string  $limit ��������
	 * @return  object
	 *
	 */
	public function limit($limit)
	{
		$this->option['limit'] = ' limit '.$limit;
		return $this;
	}


	/**
	 * select�Ӿ�
	 * select�Ӿ�֮��Ӧ���������Ӿ�
	 * @return array һ����Ԫ����
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
	 * ֻ��ȡһ�м�¼������һ��һά����
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
	 * ����һ���ֶΣ�������find����
	 * @param   $f    //��Ҫȡ�õ��ֶε�����
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
	 * �õ���¼������
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
	 * insert����,����һ�����ݵ����ݿ���
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
		str_replace('\'','\'\'',$values);   //��һ�����Ż����������ţ��Է�����뵽���ݿ���
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
	 * �������ݿ��е�����
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
				$value = str_replace('\'','\'\'',$value);   //��һ�����Ż����������ţ��Է�����뵽���ݿ���

				$field .= $key."='".$value."', ";
			}
			$field = trim($field);
			$field = substr($field,0,-1); //ȥ�����Ķ���
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
	 * @return bool ɾ��������
	 */
	public function delete($where = null)
	{
		if($where != null and strpos($where,','))   //ͨ��id����ɾ��
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
	 * �ֶμ�1
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
	 * ����$sql��ѯ�ַ���
	 * ����˵����
	 *      - Ĭ��ֵ select
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
				die('�����ڳ���ɾ����'.$this->option['table'].'�е��������ݣ��Ѿ���������ֹ');
			return $this->sql;

		}

		//update
		if($a == 'u')
		{
			if($this->option['where'] != '')
				$this->sql = "update ".$this->option['table']." set "." ## ".$this->option['where'];
			else
				die('�����ڳ����޸ı�'.$this->option['table'].'�е��������ݣ��Ѿ���������ֹ');
			return $this->sql;
		}
	}

}