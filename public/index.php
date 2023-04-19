<?php

session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'function.php';
require base_path('database.php');

// spl_autoload_register(function ($class) {
//   $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
//   require base_path("{$class}.php");
// });

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if(array_key_exists($uri,$routes)){

  require base_path($routes[$uri]); 

}else{

  echo "404 Not Found.";

}

