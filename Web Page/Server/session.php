<?php


class Session{
	private $logged;
	private $userID;
	private $username;

	public function __construct(){
	  if($_SESSION['login'] == NULL){
	  	throw new Exception('Not logged in.');
	  }

	  $this->login = $_SESSION['login'];
      $this->username = $_SESSION['username'];
      $this->userID = $_SESSION['userID'];
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