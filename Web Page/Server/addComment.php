<?php  
	header('Content-Type: application/json');
    include 'database.php';
    include 'session.php';

    $response = array();
    $database = new Database;
    $session = new Session;

    $eventID = $_POST['eventID'];
    $userID = $session->getUserID();
  	$commentDate = $_POST['commentDate'];
    $commentary = $_POST['editdescription'];

    if($commentary ==""){
    	printErrorMessage($response, 'You neeed to write something on the comment!');
        return;
    }

    $database->addComment($userID,$eventID,$commentDate,$comment);

    $response['success'] = 'Event Updated!!! Refresh the page to check the modifications!';
    echo json_encode($response);
    return;


  function printErrorMessage($responseArray, $message) {
    $responseArray['error'] = $message . ' Profile information remains the same!';
    echo json_encode($responseArray);
    return;
  }

?>