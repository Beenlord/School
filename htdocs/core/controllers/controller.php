<?php

	class controller {

		public static function model($model) {
			$args = func_get_args(); array_shift($args);
			require_once F_MODELS . DS . $model . PHP;
			return new $model(...$args);
		}

		public static function view($view, $data = []) {
			foreach ($data as $key => &$value) {
				$$key = $value;
			}
			require_once F_VIEWS . DS . $view . PHTML;
		}
	}