<?php
  
  namespace core\models;
  
  class UserModel extends Model
  {
	private $table_name = "users";
	
	public function __construct() {
	  self::setupDbConnection();
	}
	
	//public function createUser($name, $password) {
	//	$user = self::dispense("users");
	//	$user -> name = $name;
	//	$user -> password = $password;
	//	return self::store($user);
	//}
	//
	//public function saveUser($user) {
	//	return self::store("users", $user);
	//}
	//
	//public function getUserById($id) {
	//	return self::load("users", $id);
	//}
  }