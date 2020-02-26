<?php


class Edu_course_teacher_model extends CI_Model
{
//	老师课程关联表主键
	private $id;
//	课程id
	private $courseId;
//	老师id
	private $teacherId;
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
//	学校id
	private $schoolId;

//	根据学校id删除老师课程关联表
	public function deleteCourseTeacherBySchoolId($schoolId,$delTime){
		$this->db->set('isdel', 1);
		$this->db->set('modifyTime', $delTime);
		$this->db->where("schoolId",$schoolId);
		$bool = $this->db->update('edu_course_teacher');
		return $bool;
	}
//	根据课程id删除老师课程关联表
	public function deleteCoutseTeacherByCourseId($courseId,$deleteTeacherId,$deleteTime){
		$this->db->set('isdel', 1);
		$this->db->set('modifyTime', $deleteTime);
		$this->db->set('modifyTeacherId',$deleteTeacherId);
		$this->db->where("id",$courseId);
		$bool = $this->db->update('edu_course_teacher');
		return $bool;
	}
}
