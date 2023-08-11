<?php

	namespace core;

  if (!defined("RMP")) {
	  // RMP - Префиксы предназначены для того,
	  // чтобы отделять открытые api методы.
	  define("RMP", "_");
	}

	final class Application
	{
		private static array  $request = []; // Распаршенная URI строка
		private static array  $routes  = []; // Кастомные URL пути
		private static mixed  $controller;
		private static string $method;

		public static function create(): void
		{
			self::$request = self::getUrlArray(self::getUrl());
			self::setController("PageController");

			if (isset(self::$request[0]) && array_key_exists(self::$request[0],
					self::$routes)) {
				$route = self::$routes[ self::$request[0] ];
				self::setController($route["controller"]);
				unset(self::$request[0]);
			}

			self::$controller = new self::$controller();
			self::setMethod("index");

			if (isset(self::$request[1]) && method_exists(self::$controller,
					RMP . self::$request[1])) {
				self::setMethod(self::$request[1]);
				unset(self::$request[1]);
			}

			call_user_func_array([
				self::$controller,
				self::$method,
			], self::$request);
		}

		public static function addRoute($routes): void
		{
			foreach ($routes as $route => $controller) {
				self::$routes[ $route ] = [
					"controller" => $controller,
				];
			}
		}

		private static function setController($name): void
		{
			self::$controller = "core\\controllers\\" . $name;
		}

		private static function setMethod($name): void
		{
			self::$method = RMP . $name;
		}

		private static function getUrl(): string
		{
			return explode("?", $_SERVER["REQUEST_URI"])[0];
		}

		private static function getUrlArray($url): array
		{
			$parts = explode(DS, rtrim(ltrim($url, DS), DS));
			return $parts && $parts[0] ? $parts : [];
		}
	}
