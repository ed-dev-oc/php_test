<?php
class Routes{
	
	private static $routes = [
		"/" => "controllers/homepage.php"
	];
	
	function call(){
		$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
		
		if (array_key_exists($uri, self::$routes)){
			require self::$routes[$uri];
		}else{
			$this->error_path();
		}
	}
	
	function error_path($code = 404){
		http_response_code($code);
		
		require "views/{$code}.php";
	}
}

$routes = new Routes();
$routes->call();