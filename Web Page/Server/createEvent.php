<?php
    header('Content-Type: application/json');
    include 'database.php';
    include 'session.php';

    $response = array();
    $database = new Database;
    $session = new Session;

    //acho que não preciso disto
    $username = $session->getUsername();
    $userID = $session->getUserID();
    
    //data do post
    $eventName = $_POST['eventName'];
    $eventType = $_POST['eventType'];
    $eventLocation = $_POST['eventLocation'];
    $eventDescription = $_POST['eventDescription'];
    $eventDate = $_POST['eventDate'];
    $currentDate = date("Y-m-d");  
    
    if($_POST['eventPrivacy'] == 'Public')
      $eventPrivacy=false;
    else
      $eventPrivacy=true;


    $outputdir = "../Resources/EventPics/";
    $ImageName = str_replace(' ', '-', strtolower($_FILES['eventImage']['name']));
      if($ImageName != ""){
 
    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt = str_replace('.', '', $ImageExt);
    $extensions = array("jpeg", "jpg", "png");

 
      if((($_FILES["eventImage"]["type"] == "image/png") || ($_FILES["eventImage"]["type"] == "image/jpg") || ($_FILES["eventImage"]["type"] == "image/jpeg")) && in_array($ImageExt, $extensions))
      {
        if(file_exists("../Resources/EventPics/" . $ImageName))
        {
          printErrorMessage($response, 'There is already an image with this name!!!');
          return;
        }
        else{
          move_uploaded_file($_FILES["eventImage"]["tmp_name"], $outputdir . $ImageName);
          $photoEdit = true;
        }
      }
      else {
        printErrorMessage($response, 'Invalid image extension! Required .png, .jpeg or .jpg');
        return;
      }
    }

    $imageURL = $outputdir . $ImageName;
    
    if($eventName == ""){
      printErrorMessage($response, 'Invalid event name!');
        return;
    }
    if($eventLocation == ""){
      printErrorMessage($response, 'Invalid event location!');
      return;
    }
    if($eventDescription==""){
      printErrorMessage($response, 'Invalid event description!');
      return;
    }


    $database->createEvent($userID,$eventDescription,$eventName,$imageURL,$eventLocation,$eventPrivacy,$currentDate,$eventDate);

    $response['success'] = 'Event created!!! Refresh the page to check the modifications!';
    echo json_encode($response);
    return;



  function printErrorMessage($responseArray, $message) {
    $responseArray['error'] = $message . ' Events information need to be complete!';
    echo json_encode($responseArray);
    return;
  }
?>