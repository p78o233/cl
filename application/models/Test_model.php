<?php


class Test_model extends CI_Model
{
	private $id;
	private $name;
	private $age;
	private $deleted_at;

	public function getTest($id){
		$query = $this->db->select('*')->where("id",$id)->get('test');
//		返回object数组
		return $query->result();
//		返回二位数组
//		return $query->result_array();
//		返回一个对象
//		return $query->row();
//		返回一维数组
//		return $query->row_array();
	}

	public function insertTest(){
		$this->name = $_POST['name'];
		$this->age = $_POST['age'];
		$this->deleted_at = time();
		$this->db->insert($this);
	}

	public function updateTest(){
		$this->name = $_POST['name'];
		$this->age = $_POST['age'];
		$this->deleted_at = time();
		$this->db->update($this);
	}
}
