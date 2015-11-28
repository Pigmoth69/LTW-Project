<?php

class Database{
	private database;

	public function __contructor(){
		try{
			$this->database = new PDO('sqlite:../Database/database.db');
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	//returns the user if exists
	public function checkIfUserExists($username){
		$stmt = $this->$database->prepare('SELECT * FROM User WHERE username = :username');
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetchAll();
		if($user == null)
			return false;
		else
			return $user;
	}

	public function insertUser($username,$email,$password){
		try{
			$dbPassword = password_hash($password, PASSWORD_BCRYPT);
			$stmt = $database->prepare('INSERT INTO User(username, email, password) VALUES (:username, :email, :password)');
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $dbPassword, PDO::PARAM_STR);
			$stmt->execute();
		}catch{
			die($e->getMessage());
		}
	}

	public function checkLogin($username,$password){
		$user = $checkIfUserExists($username);
		if($user!=false){
			$dbPassword = $user[0][3];
			if(!password_verify($password, $dbPassword)) 
				return false; // invalid password
			else
				return true;
		}else
		return false; // invalid username
	}
}

?>