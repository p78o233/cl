<?php


class TestController extends CI_Controller
{
	public function index()
	{
		echo 'Hello World!';
	}

	public function comment(){
		echo 'comment 方法';
	}
//	接收application/json参数
	public function postJsonParam(){
		$data =  file_get_contents('php://input', 'r');
		$jsonObj =  json_decode($data, true);
		echo $jsonObj['name'];
		echo $jsonObj['id'];
		echo json_encode($jsonObj);
	}
//	接收application/json  使用类似javaDto的方法
	public function getObject(){
		$this->load->model('test_model');
		$test = new Test_model();
		$test =  file_get_contents('php://input', 'r');
		echo json_encode( json_decode($test, true));
	}
//	接收restful 参数
	public function getRestUrl($name,$id){
		echo $name;
		echo $id;
	}
//	数据库查询
	public function getTest($id){
		$this->load->model('test_model');
		$result['data'] = $this->test_model->getTest($id);
		$result['ret'] = true;
		$result['code'] = 200;
		$result['msg'] = '查询成功';
//		JSON_UNESCAPED_UNICODE  中文不转义
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
}
