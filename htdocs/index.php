<?php

	// Project: School - web application
	// Author: 	Vladimir Fomin
	
	require "helpers/RedBeanPHP.php";
	require "core/Autoloader.php";
	require "config.php";
	
	use core\Application;
	
	Application::addRoute([
		"api" => "ApiController",
	]);
	
	Application::create();
