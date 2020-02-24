<?php


class EduClassController extends CI_Controller
{
//	根据学校id，名称，入学年份获取班级分页列表
	public function getClassList(){
		$this->load->model('edu/school_admin/edu_class_model');
		$schoolId = $this->input->get('schoolId');
		$name = $this->input->get('name');
		$year = $this->input->get('year');
		$page = $this->input->get('page');
		$pageSize = $this->input->get('pageSize');
		$start = ($page-1)*$pageSize;
		$count = $this->edu_school_model->getEduClassCount($schoolId,$name,$year);
		$list = $this->edu_school_model->getEduClassPage($name,$start,$pageSize,$start,$pageSize);

		$pageInfo['count'] = $count;
		$pageInfo['list'] = $list;
		$result['data'] = $pageInfo;
		$result['ret'] = true;
		$result['code'] = 200;
		$result['msg'] = '查询成功';
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
	}

//	新增或修改班级
	public function ioeClass(){
		$this->load->model('edu/school_admin/edu_class_model\'');
		$eduClass = file_get_contents('php://input', 'r');
		$eduClassModel = new Edu_class_model();
		$eduClassModel = json_decode($eduClass);
		if(!isset($eduSchoolModel->id)){
//			新增
			$eduClassModel->createTime = date("Y-m-d H:i:s");
			$eduClassModel->modifyTime = date("Y-m-d H:i:s");
			$resultData = $this->$eduClassModel->insertClass($eduClassModel);
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
			$eduClassModel->modifyTime = date("Y-m-d H:i:s");
			$resultData = $this->$eduClassModel->editClass($eduClassModel);
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
	}

//	删除班级
	public function deleteClass(){
		$data = file_get_contents('php://input', 'r');
		$jsonObject = json_decode($data);
		$id = $jsonObject->id;
		$delAdmin =  $jsonObject->modifyAdmin;
		$delTime =  date("Y-m-d H:i:s");
		$this->load->model('edu/school_admin/edu_class_model\'');
		$resultSchool = $this->eduClassModel->deleteClass($id,$delAdmin,$delTime);
		if($resultSchool){
			$result['data'] = true;
			$result['ret'] = true;
			$result['code'] = 200;
			$result['msg'] = '删除成功';
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}else{
			$result['data'] = false;
			$result['ret'] = false;
			$result['code'] = 200;
			$result['msg'] = '删除失败';
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}
	}
}
