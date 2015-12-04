<?php


class Session{
	private $login;
	private $userID;
	private $username;

	public function __construct(){
		
		session_start();
		if(isset($_SESSION['login'])){
			if($_SESSION['login'] == true){
				$this->login = true;
				$this->userID = $_SESSION['userID'];
				$this->username = $_SESSION['username'];
			}			
		}		
	}

	public function getUserID() {
		return $this->userID;
	}

	public function getUsername() {
		return $this->username;
	}

	public function isLoggedIn() {
		return $this->login;
	}

	public function activateSession($userID, $username) {
		$_SESSION['login'] = true;
		$_SESSION['userID'] = $userID;
		$_SESSION['username'] = $username;

		$this->login = true;		
		$this->userID = $_SESSION['userID'];
		$this->username = $_SESSION['username'];

	}

	public function endSession() {
		session_start(); //Just to make sure it is started
		session_unset();
		session_destroy();
	}

}
?>