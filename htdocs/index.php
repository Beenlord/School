<?php
  
  // Project: School - web application
  // Author: 	Vladimir Fomin
  
  const DS = DIRECTORY_SEPARATOR;
  const PHP = ".php";
  const PHTML = ".phtml";
  const HTML = ".html";
  const CSS = ".css";
  const JS = ".js";
  const JSON = ".json";
  const DB = ".db";
  
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  
  require "helpers/RedBeanPHP.php";
  require "core/Autoloader.php";
  require "config.php";
  
  use core\Application;
  
  Application::addRoute([
	"api" => "ApiController",
  ]);
  
  Application::create();
