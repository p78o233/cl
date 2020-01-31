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
}
