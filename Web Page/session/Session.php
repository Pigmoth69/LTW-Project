<?php
include_once('Database.php'); 
include_once('User.php'); 

class WildBird{
	private User;
	private database;


	public function __contructor($User,$database){
		$this->User = new User();
		$this->database = new Database($database);
	}

	public function getUser(){
		return this->User;
	}




}

?>