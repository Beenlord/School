<?php

	// Project: One More Reason - web application
	// Author: 	Vladimir Fomin

	define("DS", "/");
	define("PHP", ".php");
	define("PHTML", ".phtml");
	define("HTML", ".html");
	define("JSON", ".json");

	define("F_CONTROLLS", "./core/controllers");
	define("F_MODELS", "./core/models");
	define("F_VIEWS", "./core/views");
	define("F_STORE", "./storage");

    define("ENV", require "config.php");

	class Application
	{

		private $action = "page";
		private $method = "index";
		private $params = [];

		public function __construct()
		{

			$uri = self::parseUri();

			if (isset($uri[0]) && file_exists(F_CONTROLLS . DS . $uri[0] . PHP)) {
				$this->action = $uri[0];
				unset($uri[0]);
			}

			require_once F_CONTROLLS . DS . $this->action . PHP;

			$this->action = new $this->action();

			if (isset($uri[1]) && method_exists($this->action, $uri[1])) {
				$this->method = $uri[1];
				unset($uri[1]);
			}

			if (count($uri)) {
				$this -> params = $uri;
			}

			call_user_func_array([$this->action, $this->method], $this->params);
		}

		static function parseUri()
		{
			$uri = explode("?", $_SERVER["REQUEST_URI"])[0];
			$parts = explode(DS, rtrim(ltrim($uri, DS), DS));
			return $parts && $parts[0] ? $parts : [];
		}
	}

	new Application();
