<?php
	namespace core\controllers;

	class Controller {

		// public static function model($model) {
		// 	$args = func_get_args(); array_shift($args);
		// 	require_once F_MODELS . DS . $model . PHP;
		// 	return new $model(...$args);
		// }
		//
		// public static function view($view, $data = []) {
		// 	foreach ($data as $key => &$value) {
		// 		$$key = $value;
		// 	}
		// 	require_once F_VIEWS . DS . $view . PHTML;
		// }

		protected function callSubmethod($method_name, $props = []) {
			if (method_exists($this, $method_name)) {
				call_user_func_array([$this, $method_name], $props);
			}
		}
	}