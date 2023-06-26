<?php
	
	namespace core\models;
	use R;

	class Model extends R
	{
		public function __construct() {
			self::setup(DB_CONNECTION);
		}
	}