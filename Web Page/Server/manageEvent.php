<?php
  header('Content-Type: application/json');
  
  include 'database.php';
  include 'session.php';
  
  $response = array();

  $session = new Session;
  if(!$session->isLoggedIn()){
    printErrorMessage($response, 'Not logged in');
    return;
  }

  if( $_POST['functionName'] == "" ) {
    printErrorMessage($response, 'No function name!');
    return;
  }

  if( $_POST['eventID'] == NULL ) {
    printErrorMessage($response, 'No eventID argument!');
    return;
  }

  $userID = $session->getUserID();
  $eventID = intval($_POST['eventID']);

  $database = new Database;

  $isHost = $database->isHost($userID, $eventID);

  switch($_POST['functionName']) {
    case 'leave':
      if($isHost){
        printErrorMessage($response, 'You cannot leave an event you are hosting!');
        return;
      }

      $database->removeUserFromEvent($userID, $eventID);
      $response['success'] = 'You have left the event';
      
      break;

    case 'delete':
      if(!$isHost){
        printErrorMessage($response, 'You cannot delete an event you are not hosting!');
        return;
      }

      $database->deleteEvent($eventID);
      $response['success'] = 'You have deleted the event';
  
      break;

    case 'join':
      if($database->userIsFollowing($userID, $eventID)){
        printErrorMessage($response, 'You cannot join an event you are already following!');
        return;
      }

      $database->addUserToEvent($userID, $eventID);
      $response['success'] = 'You have joined the event!';
  
      break;

    case 'invite':

      if($_POST['invitedUsername'] == NULL){
        printErrorMessage($response, 'No Username!');
        return;
      }

      $invitedUsername = $_POST['invitedUsername'];
      if(!$database->checkIfUserExists($invitedUsername)){
        printErrorMessage($response, 'The user you invited does not exist!');
        return;
      }

      $invitedUserID = intval($database->getUserID($invitedUsername));

      //add user already verifies that it's not duplicated
      if(!$database->addUserToEvent($invitedUserID, $eventID)){
        printErrorMessage($response, 'You cannot invite a user who is already in the event!');
        return;
      }

      $response['success'] = 'You have invited ' . $invitedUsername . ' to the event!';
      break;

    default: 
      $response['error'] = 'No such function';
      break;    
    }

  echo json_encode($response);

  function printErrorMessage($responseArray, $message) {
    $responseArray['error'] = $message;
    echo json_encode($responseArray);
    return;
  }
?>