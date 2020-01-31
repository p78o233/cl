<?php


class Edu_student_model extends CI_Model
{
//	学生管理表
	private $id;
//	学校id
	private $schoolId;
//	账号
	private $account;
//	昵称
	private $nickName;
//	密码
	private $pwd;
//	生日
	private $bitrh;
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
//	备注
	private $remark;
//	绑定的第一个家长的openid
	private $parentOpenIdf;
//	绑定的第二个家长的openid
	private $parentOpenIds;
//	绑定的第三个家长的openid
	private $parentOpenIdt;
//	班级id
	private $classId;

//	根据学校id删除学生
	public function deleteStudentBySchoolId($schoolId,$delTime){
		$this->db->set('isdel', 1);
		$this->db->set('modifyTime', $delTime);
		$this->db->where("schoolId",$schoolId);
		$bool = $this->db->update('edu_class');
		return $bool;
	}
}
