<?php  
	header('Content-Type: application/json');
    include 'database.php';
    include 'session.php';

    $response = array();
    $database = new Database;
    $session = new Session;

    $myfile = fopen("cenas.txt","w");
    $eventID = $_POST['eventID'];
    $userID = $session->getUserID();
  //  $commentDate = $_POST['coo'];
    $commentary = $_POST['editdescription'];
    fwrite($myfile,$userID);
    fwrite($myfile," || ");
    fwrite($myfile,$eventID);
    fwrite($myfile," || ");
    fwrite($myfile,$commentary);

/*
   /* $photoEdit = false;


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

    return;*/

  function printErrorMessage($responseArray, $message) {
    $responseArray['error'] = $message . ' Profile information remains the same!';
    echo json_encode($responseArray);
    return;
  }

?>