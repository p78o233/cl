<?php


class Edu_school_model extends CI_Model
{
//	学校表
	private $id;
//	学校名称
	private $name;
//	创建系统管理员id
	private $createAdmin;
//	创建时间
	private $createTime;
//	修改系统管理员id
	private $modifyAdmin;
//	修改时间
	private $modifyTime;
//	是否已经删除
	private $isdel;
//	描述
	private $desc;
//	官网
	private $url;

//	获取学校总数
	public function getSchoolCount($name){
		$this->db->where('isdel',0);
		if($name!=null){
			$this->db->like('name',$name);
		}
		$count = $this->db->count_all('edu_school');
		return $count;
	}
	public function getSchoolPage($name,$start,$pageSize){
		$this->db->where('isdel',0);
		if($name!=null){
			$this->db->like('name',$name);
		}
		$this->db->order_by('name', 'DESC');
		$query = $this->db->get('edu_school', $start, $pageSize);
		return $query->result();
	}
//	新增学校
	public function insertSchool($school){
		$this->db->insert('edu9_school', $school);
	}
//	修改学校
	public function updateSchool($school){
		$id = $school->id;
		$bool = $this->db->update('edu_school',$school,array('id' => $id));
		return $bool;
	}
}
