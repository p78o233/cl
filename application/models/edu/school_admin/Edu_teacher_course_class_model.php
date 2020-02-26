<?php


class Edu_teacher_course_class_model extends CI_Model
{
//	班级课程老师关联表主键
	private $id;
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
//	班级id
	private $classId;
//	课程id
	private $courseId;
//	老师id
	private $teacherId;
//	学校id
	private $schoolId;

//	根据学校id删除老师课程班级关联表
	public function deleteTeacherCourseClassBySchoolId($schoolId,$delTime){
		$this->db->set('isdel', 1);
		$this->db->set('modifyTime', $delTime);
		$this->db->where("schoolId",$schoolId);
		$bool = $this->db->update('edu_teacher_course_class');
		return $bool;
	}
//	根据课程id删除老师课程班级关联表
	public function deleteTeacherCourseClssByCourseId($courseId,$deleteTeacherId,$deleteTime){
		$this->db->set('isdel', 1);
		$this->db->set('modifyTime', $deleteTime);
		$this->db->set('modifyTeacherId',$deleteTeacherId);
		$this->db->where("id",$courseId);
		$bool = $this->db->update('edu_teacher_course_class');
		return $bool;
	}
}
