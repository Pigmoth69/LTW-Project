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
    $photo = $_POST['photo'];
    $password = $_POST['password'];
    $passwordLength = strlen($password);
    $verifyPassword = $_POST['verifyPassword'];
    $email = $_POST['email'];
    $date = $_POST['date'];

    $fullnameEdit = false;
    $photoEdit = false;
    $passwordEdit = false;
    $emailEdit = false;
    $dateEdit = false;

    if($fullname != "")
      $fullnameEdit = true;

    if($photo != "")
      $photoEdit = true;

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
   //   if($photoEdit)
   //     $database->editUserPhotoFromUserID($userID, $photo);
      if($passwordEdit)
        $database->editUserPasswordFromUserID($userID, $password);
      if($emailEdit)
        $database->editUserEmailFromUserID($userID, $email);
      if($dateEdit)
        $database->editUserBirthDateFromUserID($userID, $date);
   
      $response['success'] = 'Profile Updated!!! Refresh the page to check the modifications!';
      echo json_encode($response);
      return;
    }

  function printErrorMessage($responseArray, $message) {
    $responseArray['error'] = $message . ' Profile information remains the same!';
    echo json_encode($responseArray);
    return;
  }
?>