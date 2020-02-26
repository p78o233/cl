<?php


class EduCourseController extends CI_Controller
{
//	获取课程列表
	public function getEduCourse(){
		$this->load->model('edu/school_admin/edu_course_model');
		$schoolId = $this->input->get('schoolId');
		$courseName = $this->input->get('courseName');
		$page = $this->input->get('page');
		$pageSize = $this->input->get('pageSize');
		$start = ($page-1)*$pageSize;
		$count = $this->edu_course_model->getEduCourseCount($schoolId,$courseName);
		$list = $this->edu_course_model->getEduCoursePage($schoolId,$courseName,$start,$pageSize);

		$pageInfo['count'] = $count;
		$pageInfo['list'] = $list;
		$result['data'] = $pageInfo;
		$result['ret'] = true;
		$result['code'] = 200;
		$result['msg'] = '查询成功';
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
	}
//	新增或者修改课程
	public function ioeEduCourse(){
		$this->load->model('edu/school_admin/edu_course_model');
		$course = file_get_contents('php://input', 'r');
		$eduCourseModel = new Edu_school_model();
		$eduCourseModel = json_decode($course);
		if(!isset($eduCourseModel->id)){
//			新增
			$eduCourseModel->createTime = date("Y-m-d H:i:s");
			$eduCourseModel->modifyTime = date("Y-m-d H:i:s");
			$resultData = $this->edu_course_model->insertCourse($eduCourseModel);
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
			$eduCourseModel->modifyTime = date("Y-m-d H:i:s");
			$resultData = $this->edu_course_model->updateCourse($eduCourseModel);
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
//	删除课程
}
