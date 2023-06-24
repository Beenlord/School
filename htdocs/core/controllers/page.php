<?php

	require "controller.php";

	class page extends controller
	{

		private $view = "page";

		public function index()
		{
			self::view($this -> view, [
				"title" => ENV["title"],
			]);
		}
	}