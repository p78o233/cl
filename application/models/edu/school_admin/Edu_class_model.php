<?php


class Edu_class_model extends CI_Model
{
//	班级管理表主键
	private $id;
//	入学年份
	private $year;
//	班级名称
	private $name;
//	创建老师id
	private $createTeacherId;
//	创建时间
	private $createTime;
//	修改老师id
	private $modifyTeacherId;
//	修改时间
	private $modifyTime;
//	是否删除
	private $isdel;
//	班主任老师id
	private $masterTeacherId;
//	学校id
	private $schoolId;

//	根据学校id删除班级
	public function deleteClassBySchoolId($schoolId,$delTime){
		$this->db->set('isdel', 1);
		$this->db->set('modifyTime', $delTime);
		$this->db->where("schoolId",$schoolId);
		$bool = $this->db->update('edu_class');
		return $bool;
	}

//	根据学校id，入学年份，班级名称获取学校班级
	public function getEduClassCount($schoolId,$name,$year){
		$this->db->where('isdel', 0);
		$this->db->where('schoolId', $schoolId);
		if ($name != null) {
			$this->db->like('name', $name);
		}
		if($year != null){
			$this->db->where('year', $year);
		}
		$count = $this->db->count_all('edu_class');
		return $count;
	}
	public function getEduClassPage($schoolId,$name,$year,$start,$pageSize)
	{
		$this->db->where('isdel', 0);
		$this->db->where('schoolId', $schoolId);
		if ($name != null) {
			$this->db->like('name', $name);
		}
		if($year != null){
			$this->db->where('year', $year);
		}
		$this->db->order_by('id', 'DESC');
		$query = $this->db->limit($pageSize,$start)->get('edu_class');
		return $query->result();
	}
//	新增班级
	public function insertClass($eduClass){
		$bool = $this->db->insert('edu_class', $eduClass);
//		输出刚刚执行的sql语句
//		echo $this->db->last_query();
		return $bool;
	}
//	修改班级
	public function editClass($eduClass){
		$id = $eduClass->id;
		$bool = $this->db->update('edu_class', $eduClass, array('id' => $id));
//		echo $this->db->last_query();
		return $bool;
	}
//	删除班级
	public function deleteClass($id,$deleteTeacherId,$deleeteTime){
//		事务开始
		$this->db->trans_start();
		$this->db->set('isdel', 1);
		$this->db->set('modifyTeacherId', $deleteTeacherId);
		$this->db->set('modifyTime', $deleeteTime);
		$this->db->where("id",$id);
		$bool = $this->db->update('edu_class');
//		根据班级id删除学生
		$this->load->model('edu/school_admin/edu_student_model');
		$resultStundent = $this->edu_student_model->deleteStudentByClassId($id,$deleteTeacherId,$deleeteTime);
//		事务结束
		$this->db->trans_complete();
		return $bool;
	}
}
