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
//	新增数据
	public function insertTest(){
		$this->load->model('test_model');
		$testModel = new Test_model();
		$test =  file_get_contents('php://input', 'r');
//		把前端json对象转成model对象
		$testModel = json_decode($test);
		$this->test_model->insertTest($testModel);
	}
//	更新数据
	public function updateTest(){
		$test =  file_get_contents('php://input', 'r');
		$this->load->model('test_model');
		$testModel = new Test_model();
		$testModel = json_decode($test);
		$resultData = $this->test_model->updateTest($testModel);
		if($resultData){
			$result['data'] = true;
			$result['ret'] = true;
			$result['code'] = 200;
			$result['msg'] = '更新成功';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}else{
			$result['data'] = false;
			$result['ret'] = false;
			$result['code'] = 500;
			$result['msg'] = '更新失败';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}

	}
//	删除数据
	public function deleteTest(){
		$data =  file_get_contents('php://input', 'r');
		$jsonObject = json_decode($data);
		$id = $jsonObject->id;
		$this->load->model('test_model');
		$resultData = $this->test_model->deleteTest($id);
		if($resultData){
			$result['data'] = true;
			$result['ret'] = true;
			$result['code'] = 200;
			$result['msg'] = '删除成功';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}else{
			$result['data'] = false;
			$result['ret'] = false;
			$result['code'] = 500;
			$result['msg'] = '删除失败';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}
//	逻辑删除
	public function loginDeleteTest(){
		$data =  file_get_contents('php://input', 'r');
		$jsonObject = json_decode($data);
		$id = $jsonObject->id;
		$this->load->model('test_model');
		$resultData = $this->test_model->logicDeleteTest($id,12);
		if($resultData){
			$result['data'] = true;
			$result['ret'] = true;
			$result['code'] = 200;
			$result['msg'] = '删除成功';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}else{
			$result['data'] = false;
			$result['ret'] = false;
			$result['code'] = 500;
			$result['msg'] = '删除失败';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}
	public function batchTestInsert(){
		$data =  file_get_contents('php://input', 'r');
		$jsonObject = json_decode($data);
		$this->load->model('test_model');
		$resultData = $this->test_model->batchInsertTest($jsonObject);
		echo $resultData;
	}
//	从1加到一亿
	public function add(){
		$sum = 0;
//		获取毫秒
		$time = microtime(true);
		$begin = (int)($time * 1000);
		for($i = 1 ; $i <= 100000000 ; $i++){
			$sum+=$i;
		}
		$time = microtime(true);
		$end = (int)($time * 1000);
		echo $end - $begin ;
	}
//	单个文件上传类
	public function do_upload()
	{
//		首先现在项目目录下创建uploads目录

		$config['upload_path']      = './uploads/';//文件上传路径
		$config['allowed_types']    = 'gif|jpg|png';//允许类型
		$config['max_size']     = 100; //上传最大值单位  kb
		$config['max_width']        = 1024;//图片最大宽度  0为无限
		$config['max_height']       = 768;//图片最大高度  0为无限制
		$fileName = uniqid();
		$config['file_name'] = $fileName ;//文件名
		$this->load->library('upload', $config);
		$fileExt = $this->upload->data('file_ext');
//		user_file 文件名
		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
//			echo "<pre>";print_r($data);echo "<pre>";
//			返回上传路径
			echo "http://127.0.0.1:8400/cl/uploads/".$this->upload->data('file_name');
		}
	}
}
