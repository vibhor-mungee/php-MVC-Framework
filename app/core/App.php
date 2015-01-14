<?php

class App{

	protected $controller = 'home';

	protected $method = 'index';

	protected $params = array();

	public function __construct(){
		//echo "Hello world!";
		$url = $this->parseUrl();

		//print_r($url);
	
	
		if(isset($url[0]))
		{
			//checks if the url parameter for controller exists or not
			if(file_exists('../app/controllers/' . $url[0] . '.php'))
				{
					//sets the url parameter to current controller to navigate to
					//echo "Home exists ";
					$this->controller = $url[0];
					unset($url[0]);
				}

		}
		

		//includes controller file, default if not found in above block otherwise whatever is found above
		require_once '../app/controllers/' . $this->controller . '.php';

		//echo $this->controller;
		//creates new object for current controller
		$this->controller = new $this->controller;



		if(isset($url[1]))
		{
			// checks if the method exists in the current controller
			if(method_exists($this->controller, $url[1])){
				//echo "index exists ";
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : array();
		//print_r($this->params);
		call_user_func_array(array($this->controller,$this->method), $this->params);
		
		//echo $this->method;


	
	}


	public function parseUrl(){
		if(isset($_GET['url'])){
			/*
			This part explodes the url and sanitize it to get controller name,method name and parameteres
			For example: /home/index/1/2 will explode into parts home,index,1,2
			*/
			return $url = explode('/',filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
		}
	}
	
}