<?php


class Session{
	private $logged;
	private $userID;
	private $username;

	public function __construct(){
		var_dump($_SESSION['userID']);
		var_dump($_SESSION['login']);
		var_dump($_SESSION['logged']);
		var_dump($_SESSION['logged']);
	  if($_SESSION['logged'] == NULL){
	  	throw new Exception('Not logged in.');
	  }

	  $login = $_SESSION['logged'];
      $username = $_SESSION['username'];
      $userID = $_SESSION['userID'];
	}

	public function getLogged() {
		return $this->logged;
	}

	public function getUserID() {
		return $this->userID;
	}

	public function getUsername() {
		return $this->username;
	}

}
?>