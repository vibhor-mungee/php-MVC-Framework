<?php

class Home extends Controllers
{
	public function index($name = ''){
		$user = $this->model('User');
		$name = $user->name($name);

		$this->view('home/index', array('username' => $name));
	}


}