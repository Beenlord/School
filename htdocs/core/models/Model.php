<?php
  
  namespace core\models;
  use R;
  
  class Model extends R
  {
	protected static function setupDbConnection() {
	  self::setup(DB_CONNECTION);
	  if ( !self::testConnection() )
		die('No DB connection!');
	}
	
	//public function validTableFields($has, $will_be) {
	//  return array_reduce($will_be, function($acc, $v) {
	//	if (!isset($has[$v])) {
	//	  $acc[] = $v;
	//	}
	//	return $acc;
	//  }, []);
	//}
  }