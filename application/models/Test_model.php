<?php


class Test_model extends CI_Model
{
	private $id;
	private $name;
	private $age;
	private $deleted_at;

//	查询
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
//	新增
	public function insertTest($testModel){
		$this->db->insert('test', $testModel);
	}
//	更新
	public function updateTest($test){
		$id = $test->id;
		$bool = $this->db->update('test',$test,array('id' => $id));
		return $bool;
	}
//	物理删除
	public function deleteTest($id){
		$bool = $this->db->delete('test', array('id' => $id));
		return $bool;
	}
//	逻辑删除
	public function logicDeleteTest($id,$age){
		$this->db->set('age', $age);
		$this->db->where("id",$id);
		$bool = $this->db->update('test');
//		查看执行的sql语句
//		echo $this->db->last_query();
		return $bool;
	}
}
