<?php


class Edu_teacher_model extends CI_Model
{
//	学校教师表id
	private $id;
//	教师名称
	private $name;
//	学校id
	private $schoolId;
//	账号
	private $account;
//	密码
	private $pwd;
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
//	老师职务
	private $duty;
//	描述
	private $desc;

//	根据学校id删除老师
	public function deleteTeacherBySchoolId($schoolId,$delTime){
		$this->db->set('isdel', 1);
		$this->db->set('modifyTime', $delTime);
		$this->db->where("schoolId",$schoolId);
		$bool = $this->db->update('edu_teacher');
		return $bool;
	}
}
