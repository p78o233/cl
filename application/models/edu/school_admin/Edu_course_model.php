<?php


class Edu_course_model extends CI_Model
{
//	课程管理表主键
	private $id;
//	课程名称
	private $courseName;
//	学校id
	private $schoolId;
//	创建教师id
	private $createTeacherId;
//	创建时间
	private $createTime;
//	修改教师id
	private $modifyTeacherId;
//	修改时间
	private $modifyTime;
//	是否删除
	private $isdel;
//	描述
	private $desc;

//	根据学校id删除课程
	public function deleteCourseBySchoolId($schoolId,$delTime){
		$this->db->set('isdel', 1);
		$this->db->set('modifyTime', $delTime);
		$this->db->where("schoolId",$schoolId);
		$bool = $this->db->update('edu_course');
		return $bool;
	}
}
