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

	public function insertTest($testModel){
		$this->db->insert('test', $testModel);
	}

	public function updateTest($test){
		$id = $test->id;
		$bool = $this->db->update('test',$test,array('id' => $id));
		return $bool;
	}
}
