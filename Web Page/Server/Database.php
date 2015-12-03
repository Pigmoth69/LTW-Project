 <?php

class Database {
	private $database;

	public function __construct(){
		try{
			$this->database = new PDO('sqlite:../Database/database.db');
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}


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
			$stmt = $this->database->prepare('INSERT INTO User(username, email, password, idphoto) VALUES (:username, :email, :password, 1)');
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
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$userEvents = $stmt->fetchAll();

		return $userEvents;
	}

	//checks if a user is the host of the event
	public function isHost($hostID, $eventID) {
		$stmt = $this->database->prepare('SELECT * FROM Event Where id = :eventID AND idHost = :hostID');
		$stmt->bindParam(':hostID', $hostID, PDO::PARAM_INT);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		$hostedEvent = $stmt->fetchAll();
		if($hostedEvent != NULL){
			return true;
		}
		else {
			return false;
		}
	}

	public function eventIsPrivate($eventID) {
		$stmt = $this->database->prepare('SELECT * FROM Event WHERE id = :eventID');
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		$events = $stmt->fetchAll();
		if($events[0][5])
			return true;
		else return false;
	}

	//returns true if user is following the event
	public function userIsFollowing($userID, $eventID) {
		$stmt = $this->database->prepare('SELECT * FROM EventUser WHERE idUser = :userID AND idEvent = :eventID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		$eventUsers = $stmt->fetchAll();
		if($eventUsers != NULL)
			return true;
		else return false;
	}

	public function getUserID($username) {
		$stmt = $this->database->prepare('SELECT id FROM User WHERE username = :username');
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$id = $stmt->fetchAll();
		if(empty($id[0]))
			return false;

		return intval($id[0][0]);
	}
	
	public function getPhotoURLFromUsername($username) {
		$stmt = $this->database->prepare('SELECT url FROM Photo, User WHERE User.username = :username and User.idphoto = Photo.id');
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user[0][0];
	}
	
	public function addUserToEvent($userID, $eventID){
		//Verify if for some reason user already exists
		$stmt = $this->database->prepare('SELECT * FROM EventUser Where idEvent = :eventID AND idUser = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		$existingUserEvents = $stmt->fetchAll();
		if(!empty($existingUserEvents))
			return false;

		$stmt = $this->database->prepare('INSERT INTO EventUser(idEvent, idUser) VALUES(:eventID, :userID)');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		return true;
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