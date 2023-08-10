<?php

	namespace core\models;

	if (!defined("F_VIEWS")) {
		define("F_VIEWS", "core/views");
	}

	if (!defined("F_LAYOUTS")) {
		define("F_LAYOUTS", "layouts");
	}

	class PageModel extends Model
	{
		private $view   = "page";
		private $layout = "default";
		private $data = [];

		public function __construct($layout = null, $view = null)
		{
			if ($layout) $this -> setLayout($layout);
			if ($view) $this -> setView($view);
		}

//		public function render($data = [])
//		{
//			foreach ($data as $key => $value) {
//				$$key = $value;
//			}
//			require_once F_LAYOUTS . DS . self::$layout . PHTML;
//		}
//
//		private function getPart(): void
//		{
//			require_once F_VIEWS . DS . self::$view . PHTML;
//		}

		public function render($data = []) {
			$this -> data = $data;

			ob_start();
			$this -> view = include F_VIEWS . DS . $this -> view . PHTML;
			$this -> view = ob_get_clean();

			require_once F_LAYOUTS . DS . $this -> layout . PHTML;
		}

		public function setLayout($layout)
		{ $this -> layout = $layout; }

		public function setView($view)
		{ $this -> view = $view; }
	}
	