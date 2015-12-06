header('Content-Type: application/json');
include 'database.php';
include 'session.php';

$database = new Database;
$session = new Session;


$username = $session->getUsername();
$userID = $session->getUserID();

try{
$database->deleteProfile($userID);
}
catch(Exception e){
  echo "merda";
}



  $response['success'] = 'Profile Updated!!! Refresh the page to check the modifications!';
  echo json_encode($response);
}

function printErrorMessage($responseArray, $message) {
  $responseArray['error'] = $message . ' Profile information remains the same!';
  echo json_encode($responseArray);
  return;
}
?>