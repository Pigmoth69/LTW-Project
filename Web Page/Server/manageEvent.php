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
  $eventID = $_POST['eventID'];

  $database = new Database;

  $isHost = $database->isHost($userID, $eventID);

  switch($_POST['functionName']) {
    case 'leave':
      if($isHost){
        printErrorMessage($response, 'You cannot leave an event you are hosting!');
        return;
      }

      $database->removeUserFromEvent($userID, $eventID);
      $response['message'] = 'You have left the event';
      
      break;

    case 'delete':
      if(!$isHost){
        printErrorMessage($response, 'You cannot delete an event you are not hosting!');
        return;
      }

      $database->deleteEvent($eventID);
      $response['message'] = 'You have deleted the event';
  
      break;

    case 'edit':
      if(!$isHost){
        printErrorMessage($response, 'You cannot edit an event you are not hosting!');
        return;
      }

      //$database->deleteEvent($eventID);
      $response['message'] = 'You have edited the event';
  
      break;

    case 'join':
      if($database->userIsFollowing($userID, $eventID)){
        printErrorMessage($response, 'You cannot join an event you are already following!');
        return;
      }

      $database->addUserToEvent($userID, $eventID);
      $response['message'] = 'You have joined the event!';
  
      break;
    }

  echo json_encode($response);

  function printErrorMessage($responseArray, $message) {
    $responseArray['error'] = $message;
    echo json_encode($responseArray);
    return;
  }
?>