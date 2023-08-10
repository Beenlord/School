<?php

	// Project: School - web application
	// Author:  Vladimir Fomin

	const DS    = DIRECTORY_SEPARATOR;
	const RMP   = "_"; // Routed method prefix
	const PHP   = ".php";
	const PHTML = ".phtml";
	const HTML  = ".html";
	const CSS   = ".css";
	const JS    = ".js";
	const JSON  = ".json";
	const DB    = ".db";

	require "helpers/RedBeanPHP.php";
	require "core/Autoloader.php";
	require "config.php";

	use core\Application;

	Application::addRoute([
		"api" => "ApiController",
	]);

	Application::create();
