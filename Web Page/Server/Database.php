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

		if($events[0]['private'])
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
		if(!empty($eventUsers))
			return false;
		else return true;
	}

	public function getAllUsers() {
		$stmt = $this->database->prepare('SELECT * FROM User');
		$stmt->execute();
		return $stmt->fetchAll();
	}

	///////////////////////////////////////
	////////////GET USER INFO//////////////
	///////////////////////////////////////
	public function getUserID($username) {
		$stmt = $this->database->prepare('SELECT id FROM User WHERE username = :username');
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$id = $stmt->fetchAll();
		if(empty($id[0]))
			return false;

		return intval($id[0]['id']);
	}

	public function getPhotoURLFromUserID($userID) {
		$stmt = $this->database->prepare('SELECT url FROM Photo, User WHERE User.id = :userID and User.idphoto = Photo.id');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user[0]['url'];
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
		return $user[0]['fullname'];
	}

	public function getBirthFromUserID($userID) {
		$stmt = $this->database->prepare('SELECT datanascimento FROM User WHERE id = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user[0]['datanascimento'];
	}

	public function getEmailFromUserID($userID) {
		$stmt = $this->database->prepare('SELECT email FROM User WHERE id = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetchAll();
		return $user[0]['email'];
	}

	public function getUserOwnedEvents($userID) {
		$stmt = $this->database->prepare('SELECT id FROM Event WHERE idHost = :id');
		$stmt->bindParam(':id', $userID, PDO::PARAM_INT);
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

	///////////////////////////////////////
	////////////EDIT USER INFO/////////////
	///////////////////////////////////////
	public function editUserFullnameFromUserID($userID, $fullname){
		$stmt = $this->database->prepare('UPDATE User SET fullname = :fullname WHERE id = :userID');
		$stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		return;
	}

	public function editUserPasswordFromUserID($userID, $password){
		$dbPassword = password_hash($password, PASSWORD_BCRYPT);
		$stmt = $this->database->prepare('UPDATE User SET password = :password WHERE id = :userID');
		$stmt->bindParam(':password', $dbPassword, PDO::PARAM_STR);
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		return;
	}

	public function editUserPhotoFromUserID($userID,$photoURL){
		$stmt = $this->database->prepare('INSERT INTO Photo(URL) VALUES(:photoURL)');
		$stmt->bindParam(':photoURL', $photoURL, PDO::PARAM_STR);
		$stmt->execute();
		$stmt = $this->database->prepare('SELECT id FROM photo WHERE url = :photoURL');
		$stmt->bindParam(':photoURL', $photoURL, PDO::PARAM_STR);
		$stmt->execute();
		$id = $stmt->fetchAll()[0][0];
		$stmt = $this->database->prepare('UPDATE User SET idphoto = :id where id = :userID');
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		return true;
	}

	public function editUserEmailFromUserID($userID, $email){
		$stmt = $this->database->prepare('UPDATE User SET email = :email WHERE id = :userID');
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		return;
	}

	public function editUserBirthDateFromUserID($userID, $birth){
		$stmt = $this->database->prepare('UPDATE User SET datanascimento = :birth WHERE id = :userID');
		$stmt->bindParam(':birth', $birth, PDO::PARAM_STR);
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		return;
	}

	///////////////////////////////////////
	////////////GET EVENT INFO/////////////
	///////////////////////////////////////
	public function getPhotoURLFromEventID($eventID) {
		$stmt = $this->database->prepare('SELECT url FROM Photo, Event WHERE Event.id = :eventID AND Event.idPhoto = Photo.id');
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		$event = $stmt->fetchAll();
		return $event[0]['url'];
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

	public function getAllEvents(){
		$stmt = $this->database->prepare('SELECT * FROM Event');
		$stmt->execute();
		$events = $stmt->fetchAll();
		return $events;
	}



	///////////////////////////////////////
	////////////EDIT EVENT INFO////////////
	///////////////////////////////////////

	public function removeUserFromEvent($userID, $eventID) {
		$stmt = $this->database->prepare('DELETE FROM EventUser Where idUser = :userID AND idEvent = :eventID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function deleteEvent($eventID) {
		//Remove every user from the event to be deleted
		$stmt = $this->database->prepare('DELETE FROM EventUser Where idEvent = :eventID');
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();

		//Delete the event
		$stmt = $this->database->prepare('DELETE FROM Event Where id = :eventID');
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function addUserToEvent($userID, $eventID){
		//Verify if for some reason user already exists in Event
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
	//(IDHOST,DESCRIPTION, NAME, IDPHOTO, IDLOCATION, PRIVATE, CREATIONDATE, EVENTDATE)
	public function createEvent($userID,$eventDescription,$eventName,$photoURL,$location,$eventPrivacy,$type,$creationDate,$eventDate){
		$stmt = $this->database->prepare('INSERT INTO Photo(URL) VALUES(:photoURL)');
		$stmt->bindParam(':photoURL', $photoURL, PDO::PARAM_STR);
		$stmt->execute();
		$stmt = $this->database->prepare('SELECT id FROM photo WHERE url = :photoURL');
		$stmt->bindParam(':photoURL', $photoURL, PDO::PARAM_STR);
		$stmt->execute();
		$id = $stmt->fetchAll()[0][0];
		$stmt = $this->database->prepare('INSERT INTO Event(idhost,description,name,idphoto,location,private,type,creationdate,eventdate) VALUES(:idhost, :description,:name,:idphoto,:location,:private,:type,:creationdate,:eventdate)');
		$stmt->bindParam(':idhost', $userID, PDO::PARAM_INT);
		$stmt->bindParam(':description', $eventDescription, PDO::PARAM_STR);
		$stmt->bindParam(':name', $eventName, PDO::PARAM_STR);
		$stmt->bindParam(':idphoto', $id, PDO::PARAM_INT);
		$stmt->bindParam(':location', $location, PDO::PARAM_STR);
		$stmt->bindParam(':private', $eventPrivacy, PDO::PARAM_INT);
		$stmt->bindParam(':type', $type, PDO::PARAM_STR);
		$stmt->bindParam(':creationdate', $creationDate, PDO::PARAM_STR);
		$stmt->bindParam(':eventdate', $eventDate, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function editEventNameFromEventID($eventID, $name)
	{
		$stmt = $this->database->prepare('UPDATE Event SET name = :name WHERE id = :eventID');
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function editEventPhotoFromEventID($eventID, $photoURL)
	{
		$stmt = $this->database->prepare('INSERT INTO Photo(URL) VALUES(:photoURL)');
		$stmt->bindParam(':photoURL', $photoURL, PDO::PARAM_STR);
		$stmt->execute();
		$stmt = $this->database->prepare('SELECT id FROM photo WHERE url = :photoURL');
		$stmt->bindParam(':photoURL', $photoURL, PDO::PARAM_STR);
		$stmt->execute();
		$id = $stmt->fetchAll()[0][0];
		$stmt = $this->database->prepare('UPDATE Event SET idphoto = :id where id = :eventID');
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function editEventDescriptionFromEventID($eventID, $description)
	{
		$stmt = $this->database->prepare('UPDATE Event SET description = :description WHERE id = :eventID');
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function editEventLocationFromEventID($eventID, $location)
	{
		$stmt = $this->database->prepare('UPDATE Event SET location = :location WHERE id = :eventID');
		$stmt->bindParam(':location', $location, PDO::PARAM_STR);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function editEventDateFromEventID($eventID, $eventdate)
	{
		$stmt = $this->database->prepare('UPDATE Event SET eventDate = :eventdate WHERE id = :eventID');
		$stmt->bindParam(':eventdate', $eventdate, PDO::PARAM_STR);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function editEventTypeFromEventID($eventID, $type)
	{
		$stmt = $this->database->prepare('UPDATE Event SET type = :type WHERE id = :eventID');
		$stmt->bindParam(':type', $type, PDO::PARAM_STR);
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
	}


	///////////////////////////////////////
	////////////DELETING USER /////////////
	///////////////////////////////////////
	public function deleteUser($userID) {
		//delete user
		$stmt = $this->database->prepare('DELETE FROM User Where id = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
	}

	//Checks if user to be deleted hosts anything. if so, cannot delete profile
	public function userHostedEvents($userID) {
		$stmt = $this->database->prepare('SELECT name FROM Event Where idhost = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
		$hostedEvents = $stmt->fetchAll();
		return $hostedEvents;
	}

	//Remove user from all the events he's in
	public function removeUserFromAllEvents($userID) {
		$stmt = $this->database->prepare('DELETE FROM EventUser Where idUser = :userID');
		$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
		$stmt->execute();
	}


	public function getComments($eventID){
		$stmt = $this->database->prepare('SELECT * FROM Commentary WHERE idEvent = :eventID ORDER BY commentdate');
		$stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
		$stmt->execute();
		$comments = $stmt->fetchAll();
		return $comments;
	}

}


//faz o check de valid email
function checkValidEmail($email){
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }else{
      	return false;
    }
}
?>