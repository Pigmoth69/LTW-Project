<?php


class Database{
	private $database;

	 public function __construct(){
		try{
			$this->database = new PDO('sqlite:../Database/database.db');
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	//returns the user if exists
	public function checkIfUserExists($username){
		$stmt = $this->database->prepare('SELECT * FROM User WHERE username = :username');
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user;
	}

	public function checkIfEmailExists($email){
		$stmt = $this->database->prepare('SELECT email FROM User Where email == :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $mail = $stmt->fetchAll();
        return $mail;
	}

	public function insertUser($username,$email,$password){
		try{
			$dbPassword = password_hash($password, PASSWORD_BCRYPT);
			$stmt = $this->database->prepare('INSERT INTO User(username, email, password) VALUES (:username, :email, :password)');
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $dbPassword, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (Exception $e){
			die($e->getMessage());
		}
	}
	 public function checkValidLogin($username,$password){
		$user = $this->checkIfUserExists($username);
		if($user!=null){
			$dbPassword = $user[0][3];
			if(!password_verify($password, $dbPassword)) 
				return false; // invalid password
			else
				return true;
		}else
		return false; // invalid username
	}



	public function checkValidRegister($username,$password,$verifyPassword,$email){

		$user = $this->checkIfUserExists($username);

		if($user != null)
			return "Username already taken!";
		if($verifyPassword != $password)
			return 'Password mismatch!';
		if(!checkValidEmail($email))
			return "Invalid email!";	
		if($this->checkIfEmailExists($email))
			return "Email Already taken! Try another one!";
		return true;
	}

	public function getAllEvents(){
		$stmt = $this->database->prepare('SELECT * FROM Event');
		$stmt->execute();
		$events = $stmt->fetchAll();
		return $events;
	}

	//gets all events that the user has access to.
	public function getUserEvents($userID) {
		$stmt = $this->database->prepare('SELECT * FROM Event JOIN EventUser on EventUser.idEvent = Event.id WHERE EventUser.idUser = :userID');
		$stmt->bindParam(':userID', $userID);
		$stmt->execute();
		$userEvents = $stmt->fetchAll();

		return $userEvents;
	}

	//checks if a user is the host of the event
	public function isHost($userID, $eventID) {
		$stmt = $this->database->prepare('SELECT idEvent FROM User JOIN Event on Event.idHost = :userID WHERE Event.id = :eventID');
		$stmt->bindParam(':userID', $userID);
		$stmt->bindParam(':eventID', $eventID);
		$stmt->execute();
		$hostedEvent = $stmt->fetch();
		if(isset($hostedEvent))
			return true;
		else return false;
	}

}

	//ifaz o check de valid email da google da think
	function checkValidEmail($email){
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          return true;
        }else{
        	return false;
        }
	}
?>