<?php

	namespace core\controllers;

	class ApiController extends Controller
	{
		private $view = "json";

		public function _index() {
			echo "This is api controller";
		}

		public function _v0($method = "index") {
			if ($method) self::callSubmethod($method);
		}

		public function get_users() {
			var_dump([]);
		}
	}
	