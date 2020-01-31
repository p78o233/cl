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
//	省
	private $province;
//	市
	private $city;
//	区
	private $area;
//	详细地址
	private $address;
//	获取学校总数
	public function getSchoolCount($name)
	{
		$this->db->where('isdel', 0);
		if ($name != null) {
			$this->db->like('name', $name);
		}
		$count = $this->db->count_all('edu_school');
		return $count;
	}

	public function getSchoolPage($name, $start, $pageSize)
	{
		$this->db->where('isdel', 0);
		if ($name != null) {
			$this->db->like('name', $name);
		}
		$this->db->order_by('name', 'DESC');
		$query = $this->db->get('edu_school', $start, $pageSize);
		return $query->result();
	}

//	新增学校
	public function insertSchool($school)
	{
		$bool = $this->db->insert('edu_school', $school);
//		输出刚刚执行的sql语句
//		echo $this->db->last_query();
		return $bool;
	}

//	修改学校
	public function updateSchool($school)
	{
		$id = $school->id;
		$bool = $this->db->update('edu_school', $school, array('id' => $id));
//		echo $this->db->last_query();
		return $bool;
	}
//	删除学校
	public function deleteSchool($id,$delAdmin,$delTime){
		$this->db->trans_start();
		$this->db->set('isdel', 1);
		$this->db->set('modifyAdmin', $delAdmin);
		$this->db->set('modifyTime', $delTime);
		$this->db->where("id",$id);
		$bool = $this->db->update('edu_school');
//		删除学校老师
		$this->load->model('edu/school_admin/edu_teacher_model');
		$resultTeacher = $this->edu_teacher_model->deleteTeacherBySchoolId($id,$delTime);
//		删除学校班级
		$this->load->model('edu/school_admin/edu_class_model');
		$resultClass = $this->edu_class_model->deleteClassBySchoolId($id,$delTime);
//		删除学校学生
		$this->load->model('edu/school_admin/edu_student_model');
		$resultStundent = $this->edu_student_model->deleteStudentBySchoolId($id,$delTime);
		$this->db->trans_complete();
		return $bool;
	}
}
