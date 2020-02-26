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
//	根据学校id以及课程名称查看学校开设课程
	public function getEduCourseCount($schoolId,$courseName){
		$this->db->where('isdel',0);
		$this->db->where('schoolId',$schoolId);
		if($courseName != null){
			$this->db->like('courseName',$courseName);
		}
		$count = $this->db->count_all('edu_course');
		return $count;
	}
	public function getEduCoursePage($schoolId,$courseName,$start,$pageSize){
		$this->db->where('isdel',0);
		$this->db->where('schoolId',$schoolId);
		if($courseName != null){
			$this->db->like('courseName',$courseName);
		}
		$this->db->order_by('id', 'DESC');
		$query = $this->db->limit($pageSize,$start)->get('edu_course');
		return $query->result();
	}
//	新增课程
	public function insertCourse($eduCourse){
		$bool = $this->db->insert('edu_course',$eduCourse);
		return $bool;
	}
//	修改课程
	public function updateCourse($eduCourse){
		$id = $eduCourse->id;
		$bool = $this->db->update('edu_course', $eduCourse, array('id' => $id));
//		echo $this->db->last_query();
		return $bool;
	}
//	删除课程
	public function deleteCourse($id,$deleteTeacherId,$deleteTime){
		$this->db->trans_start();
		$this->db->set('isdel', 1);
		$this->db->set('$modifyTeacherId', $deleteTeacherId);
		$this->db->set('modifyTime', $deleteTime);
		$this->db->where("id",$id);
		$bool = $this->db->update('edu_school');
//		删除课程教师班级管理表数据
		$this->load->model('edu/school_admin/edu_teacher_course_class_model');
		$resultTeaCourCla = $this->edu_teacher_course_class_model->deleteTeacherCourseClssByCourseId($id,$deleteTeacherId,$deleteTime);
//		删除课程教师关联表数据

		$this->db->trans_complete();
		return $bool;
	}
}
