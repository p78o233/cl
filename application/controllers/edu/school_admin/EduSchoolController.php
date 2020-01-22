<?php


class EduSchoolController extends CI_Controller
{
//	获取学校个数
	public function getEduSchoolList()
	{
		$this->load->model('edu/school_admin/edu_school_model');
		$name = $this->input->get('name');
		$page = $this->input->get('page');
		$pageSize = $this->input->get('pageSize');
		$start = ($page-1)*$pageSize;
		$count = $this->edu_school_model->getSchoolCount($name);
		$list = $this->edu_school_model->getSchoolPage($name,$start,$pageSize);

		$pageInfo['count'] = $count;
		$pageInfo['list'] = $list;
		$result['data'] = $pageInfo;
		$result['ret'] = true;
		$result['code'] = 200;
		$result['msg'] = '查询成功';
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
	}
//	新增或者修改学校
	public function ioeEduSchool(){
		$this->load->model('edu/school_admin/edu_school_model');
		$school = file_get_contents('php://input', 'r');
		$eduSchoolModel = new Edu_school_model();
		$eduSchoolModel = json_decode($school);
		if(!$eduSchoolModel->id){
//			新增
			$eduSchoolModel->createTime = time();
			$eduSchoolModel->modifyTime = time();
			$resultData = $this->edu_school_model->insertSchool($eduSchoolModel);
			if($resultData){
				$result['data'] = true;
				$result['ret'] = true;
				$result['code'] = 200;
				$result['msg'] = '新增成功';
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			}else{
				$result['data'] = false;
				$result['ret'] = false;
				$result['code'] = 200;
				$result['msg'] = '新增失败';
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			}
		}else{
//			修改
			$eduSchoolModel->modifyTime = time();
			$resultData = $this->edu_school_model->updateSchool($eduSchoolModel);
			if($resultData){
				$result['data'] = true;
				$result['ret'] = true;
				$result['code'] = 200;
				$result['msg'] = '更新成功';
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			}else{
				$result['data'] = false;
				$result['ret'] = false;
				$result['code'] = 200;
				$result['msg'] = '更新失败';
				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			}
		}
		echo gettype($eduSchoolModel);
	}
}
