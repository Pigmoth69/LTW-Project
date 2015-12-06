<?php
    header('Content-Type: application/json');
    include 'database.php';
    include 'session.php';

    $response = array();
    $database = new Database;
    $session = new Session;


    $username = $session->getUsername();
    $eventID = $_POST['eventID'];
    $userID = $session->getUserID();
    $name = $_POST['name'];
    $description = $_POST['editdescription'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $type = $_POST['eventtype'];
    $outputdir = "../Resources/EventPics/";
    $ImageName = str_replace(' ', '-', strtolower($_FILES['photo']['name']));


    $photoEdit = false;


    if($ImageName != ""){

      $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
      $ImageExt = str_replace('.', '', $ImageExt);
      $extensions = array("jpeg", "jpg", "png");


      if((($_FILES["photo"]["type"] == "image/png") || ($_FILES["photo"]["type"] == "image/jpg") || ($_FILES["photo"]["type"] == "image/jpeg")) && in_array($ImageExt, $extensions))
      {
        if(file_exists("../Resources/EventPics/" . $ImageName))
        {
          printErrorMessage($response, 'There is already an image with this name!!!');
          return;
        }
        else{
          move_uploaded_file($_FILES["photo"]["tmp_name"], $outputdir . $ImageName);
          $photoEdit = true;
        }
      }
      else {
        printErrorMessage($response, 'Invalid image extension! Required .png, .jpeg or .jpg');
        return;
      }
    }    



    if($name != "" || $photoEdit || $description != "" || $location != "" || $date != "" || $type != "----")
    {
      if($name != "")
        $database->editEventNameFromEventID($eventID, $name);
      if($photoEdit)
        $database->editEventPhotoFromEventID($eventID, $outputdir . $ImageName);
      if($description != "")
        $database->editEventDescriptionFromEventID($eventID, $description);
      if($location != "")
        $database->editEventLocationFromEventID($eventID, $location);
      if($date != "")
        $database->editEventDateFromEventID($eventID, $date);
      if($type != "----")
        $database->editEventTypeFromEventID($eventID, $type);

      $response['success'] = 'Event Updated!!! Refresh the page to check the modifications!';
      echo json_encode($response);
      return;
    }
    else printErrorMessage($response, 'No inputs detected.');

    return;

  function printErrorMessage($responseArray, $message) {
    $responseArray['error'] = $message . ' Profile information remains the same!';
    echo json_encode($responseArray);
    return;
  }
?>