 <?php

include('../lib/password.php');

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
			$stmt = $this->database->prepare('INSERT INTO User(username, fullname, email, password, idphoto) VALUES (:username, " ",  :email, :password, 1)');
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
			$dbPassword = $user[0]['password'];
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



	/***********GET USERS INFO FROM ID PARAM************/
	public function getPhotoURLFromUserID($userID) {
		$stmt = $this->database->prepare('SELECT url FROM Photo, User WHERE User.id = :userID and User.idphoto = Photo.id');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user[0][0];
	}

	public function getUsernameFromUserID($userID) {
		$stmt = $this->database->prepare('SELECT username FROM User WHERE id = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user[0]['username'];
	}

	public function getFullnameFromUserID($userID) {
		$stmt = $this->database->prepare('SELECT fullname FROM User WHERE id = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user[0][0];
	}

	public function getBirthFromUserID($userID) {
		$stmt = $this->database->prepare('SELECT datanascimento FROM User WHERE id = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user[0][0];
	}

	public function getEmailFromUserID($userID) {
		$stmt = $this->database->prepare('SELECT email FROM User WHERE id = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user[0][0];
	}

	public function getUserOwnedEvents($id) {
		$stmt = $this->database->prepare('SELECT id FROM Event WHERE idHost = :id');
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$events = $stmt->fetchAll();
		return $events;
	}


	// GET EVENT INFORMATION
	public function getPhotoURLFromEventID($eventID) {
		$stmt = $this->database->prepare('SELECT url FROM Photo, Event WHERE Event.id = :eventID AND Event.idPhoto = Photo.id');
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		$event = $stmt->fetchAll();
		return $event[0][0];
	}

	public function getEventFromEventID($eventID) {
		$stmt = $this->database->prepare('SELECT * FROM Event WHERE Event.id = :eventID');
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		$event = $stmt->fetchAll();
		return $event[0];
	}

	public function getUsernamesInEventFromEventID($eventID) {
		$stmt = $this->database->prepare('SELECT username FROM User JOIN EventUser on User.id = EventUser.idUser Where EventUser.idEvent = :eventID');
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		$usernames = $stmt->fetchAll();
		return $usernames;
	}


	//Remove User From Event
	public function removeUserFromEvent($userID, $eventID){
		$stmt = $this->database->prepare('DELETE FROM EventUser Where idEvent = :eventID AND idUser = :userID');
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
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