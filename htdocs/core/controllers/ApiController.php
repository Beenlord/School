<?php
  
  namespace core\controllers;
  
  use core\models\UserModel as User;
  use core\models\TeacherModel as Teacher;
  
  class ApiController extends Controller
  {
	private static $result = [
	  "status"  => 0,
	  "message" => "Error 404",
	];
	
	// =========
	
	public function __construct() {
	  self::setView("json");
	}
	
	public function _index() {
	  $this->jsonPrint();
	}
	
	public function _getTeachers() {
	  $teacher = new Teacher();
	  $teacher_list = $teacher->getTeacherList();
	  
	  if ( count($teacher_list) > 0 ) {
		$this->setResultStatus(200, "Ok");
		$this->setResult($teacher_list);
	  }
	  
	  $this->jsonPrint();
	}
	
	public function _setTeacher($token) {
	  if ($token === TOKEN) {
		$teacher = new Teacher();
		$fields = $teacher->validTableFields(array_keys($_GET));
	  }
	  $this->jsonPrint();
	}
	
	// =========
	
	private function setResultStatus( $status, $message = "" ) {
	  self::$result[ "status" ] = $status;
	  self::$result[ "message" ] = $message;
	}
	
	private function setResult( $content ) {
	  self::$result[ "body" ] = $content;
	}
	
	private function jsonPrint() {
	  self::print([
		"result" => self::$result,
	  ]);
	}
	
	//private function setResultContent($result) {
	//	$this -> result["content"] = $result;
	//}
	//
	//private function renderResultView() {
	//	self::renderView([
	//		"result" => $this -> result,
	//		"pre" => true,
	//	]);
	//}
  }
	