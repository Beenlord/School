<?php
  
  namespace core\models;
  
  class TeacherModel extends Model
  {
	private $table_name = "teachers";
	private $table_fields = [
	  "name",
	  "email",
	  "phone",
	];
	
	public function __construct() {
	  self::setupDbConnection();
	}
	
	public function getTeacherList() {
	  $fields = implode(", ", $this->table_fields);
	  return self::getAll("SELECT {$fields} FROM {$this->table_name}");
	}
	
	public function validTableFields( $values ) {
	  return array_reduce($this->table_fields, function($acc, $v) use (&$values) {
		if (in_array($v, $values)) {
		  $acc["includes"][] = $v;
		} else {
		  $acc["excludes"][] = $v;
		}
		return $acc;
	  }, []);
	}
  }