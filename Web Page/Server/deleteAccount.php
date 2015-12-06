<?php
  header('Content-Type: application/json');
  
  include 'database.php';
  include 'session.php';
  
  $response = array();

  $database = new Database;
  $session = new Session;
  if(!$session->isLoggedIn()){
    printErrorMessage($response, 'Not logged in');
    return;
  }

  $userID = $session->getUserID();

  //Check if he is a host
  if(!empty($database->userHostedEvents($userID))){
  	printErrorMessage($response, 'You cannot delete your profile while you are the host of an event!');
  	return;
  }

  //Eliminate all EventUser entries from the user
  $database->removeUserFromAllEvents($userID);

  //Eliminate profile pic
  $photoURL = $database->getPhotoURLFromUserID($userID);
  if($photoURL != "../Resources/ProfilePics/defaultProfilePic.png"){
  	unlink($photoURL);
  }

  //Eliminate User
  $database->deleteUser($userID);
  $response['message'] = 'Your account has been deleted. You will be logged out.';
  $session->endSession();

  echo json_encode($response);




	function printErrorMessage($responseArray, $message) {
	  $responseArray['error'] = $message;
	  echo json_encode($responseArray);
	  return;
	}
?>