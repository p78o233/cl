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
}
