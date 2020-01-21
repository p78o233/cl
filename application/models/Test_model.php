<?php


class Test_model extends CI_Model
{
	private $id;
	private $name;
	private $age;
	private $deleted_at;
	public $testId;

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
//	多条件查询
//	文档 数据库参考 查询构造器类
	public function getTestWhere(){
		$this->db->where('name','3');
		$this->db->where('age','0');
		$query = $this->db->select('*')->get('test');
		return $query->result();
	}
//	新增
	public function insertTest($testModel){
		$this->db->insert('test', $testModel);
	}
//	新增返回主键id
	public function insetTestReturnId($testModel){
		$this->db->insert('test', $testModel);
		$id = $this->db->insert_id('test');
		return $id;
	}
	//	批量插入
	public function batchInsertTest($data){
		$bool = $this->db->insert_batch('test',$data);
		return $bool;
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
