<?php
	
	namespace core\controllers;

	class Controller {

		private static $view = "page";
		
		// public static function model($model) {
		// 	$args = func_get_args(); array_shift($args);
		// 	require_once F_MODELS . DS . $model . PHP;
		// 	return new $model(...$args);
		// }

		// public static function view($view, $data = []) {
		// 	foreach ($data as $key => &$value) {
		// 		$$key = $value;
		// 	}
		// 	require_once F_VIEWS . DS . $view . PHTML;
		// }
		
		protected static function setView($view_name) {
			self::$view = $view_name;
		}
		
		protected static function print($data = []) {
			foreach ($data as $key => &$value) {
				$$key = $value;
			}
			require_once F_VIEWS . DS . self::$view . PHTML;
		}

		protected function callSubmethod($method_name, $props = []): bool {
			if (method_exists($this, $method_name)) {
				call_user_func_array([$this, $method_name], $props);
				return true;
			}
			return false;
		}
	}