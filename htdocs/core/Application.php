<?php

    namespace core;

    final class Application
    {
        private static $request = [];
        private static $routes = [];
				private static $controller = "";
        private static $method = "";

        public static function create() {
					self::$request = self::getUrlArray(self::getUrl());
	        self::setController("PageController");
					
					if (
						isset(self::$request[0]) &&
						array_key_exists(self::$request[0], self::$routes)
					) {
						$route = self::$routes[self::$request[0]];
						self::setController($route["controller"]);
						unset(self::$request[0]);
					}
					
					self::$controller = new self::$controller();
					self::setMethod("index");
					
					if (
						isset(self::$request[1]) &&
						method_exists(self::$controller, "_" . self::$request[1])
					) {
						self::setMethod(self::$request[1]);
						unset(self::$request[1]);
					}
					
					call_user_func_array([
						self::$controller,
						self::$method,
					], self::$request);
        }
	
		    public static function addRoute($routes) {
					foreach ($routes as $route => $controller) {
						self::$routes[$route] = [
							"controller" => $controller,
						];
					}
		    }
				
				public static function setController($name) {
					self::$controller = "core\\controllers\\" . $name;
				}
				
				public static function setMethod($name) {
					self::$method = "_" . $name;
				}
				
				public static function getUrl() {
					return explode("?", $_SERVER["REQUEST_URI"])[0];
				}
				
				public static function getUrlArray($url) {
					$parts = explode(DS, rtrim(ltrim($url, DS), DS));
					return $parts && $parts[0] ? $parts : [];
				}
    }
