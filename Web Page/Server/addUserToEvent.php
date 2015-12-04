 <?php
  header('Content-Type: application/json');
  include('database.php');
  include('session.php');
  
  $session = new Session;
  if(!$session->isLoggedIn()){
    $session->endSession();
    printErrorMessage($response, 'Not logged in.');
    return;
  }
  
  $response = array();


  if($_POST['eventID'] == null || !is_string($_POST['eventID'])) {
    printErrorMessage($response, 'Event does not exist!');
    return;
  }

  $eventID = intval($_POST['eventID']);
  $userID = $_SESSION['userID'];

  $database = new Database;
  if(!$database->addUserToEvent($userID, $eventID)){
    printErrorMessage($response, 'User already signed in to the event!');
    return;
  }
  
  $response['message'] = 'Successfully signed in to the event';
  echo json_encode($response);
  

  function printErrorMessage($responseArray, $message) {
    $responseArray['error'] = $message;
    echo json_encode($responseArray);
    return;
  }
  ?>