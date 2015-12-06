<?php
    header('Content-Type: application/json');
    include 'database.php';
    include 'session.php';

    $response = array();
    $database = new Database;
    $session = new Session;


    $username = $session->getUsername();
    $userID = $session->getUserID();
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $passwordLength = strlen($password);
    $verifyPassword = $_POST['verifyPassword'];
    $email = $_POST['email'];
    $date = $_POST['date'];

    $outputdir = "../Resources/ProfilePics/";
    $ImageName = str_replace(' ', '-', strtolower($_FILES['photo']['name']));

    $fullnameEdit = false;
    $photoEdit = false;
    $passwordEdit = false;
    $emailEdit = false;
    $dateEdit = false;

    if($fullname != "")
      $fullnameEdit = true;

    if($ImageName != ""){

      $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
      $ImageExt = str_replace('.', '', $ImageExt);
      $extensions = array("jpeg", "jpg", "png");


      if((($_FILES["photo"]["type"] == "image/png") || ($_FILES["photo"]["type"] == "image/jpg") || ($_FILES["photo"]["type"] == "image/jpeg")) && in_array($ImageExt, $extensions))
      {
        if(file_exists("../Resources/ProfilePics/" . $ImageName))
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

   
    if($passwordLength > 0)
    {
      if($passwordLength < 4 || $passwordLength > 32)
      {
        printErrorMessage($response, 'Password is invalid! Minimum 4 characters, maximum 32.');
        return;
      }
      else if($password == $verifyPassword)
        $passwordEdit = true;
      else {
        printErrorMessage($response, 'Password\'s don\'t match!');
        return;
      }
    }

    if(filter_var($email, FILTER_VALIDATE_EMAIL))
      $emailEdit = true;
    else if($email != ""){
      printErrorMessage($response, 'Not a valid Email!');
      return;
    }

    if($date != "")
      $dateEdit = true;

    if($fullnameEdit || $photoEdit || $passwordEdit || $emailEdit || $dateEdit)
    {
      if($fullnameEdit)
        $database->editUserFullnameFromUserID($userID, $fullname);
      if($photoEdit)
        $result = $database->editUserPhotoFromUserID($userID, $outputdir . $ImageName);
      if($passwordEdit)
        $database->editUserPasswordFromUserID($userID, $password);
      if($emailEdit)
        $database->editUserEmailFromUserID($userID, $email);
      if($dateEdit)
        $database->editUserBirthDateFromUserID($userID, $date);
   
      $response['message'] = 'Profile Updated!!! Refresh the page to check the modifications!';
      echo json_encode($response);
    }

  function printErrorMessage($responseArray, $message) {
    $responseArray['error'] = $message . ' Profile information remains the same!';
    echo json_encode($responseArray);
    return;
  }
?>