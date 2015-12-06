 <?php
  header('Content-Type: application/json');
  
  include 'database.php';
  include 'session.php';
  
  $response = array();

  /**
   *  Verify valid POST arguments
   */
  if( $_POST['functionName'] == "" ) {
    printErrorMessage($response, 'No function name!');
    return;
  }

  if( $_POST['username'] == "" ) {
    printErrorMessage($response, 'No username argument!');
    return;
  }

  if( $_POST['password'] == "" ) {
    printErrorMessage($response, 'No password argument!');
    return;
  }
  
  $usernameLength = strlen($_POST['username']);
  if($usernameLength < 4 || $usernameLength > 16){
    printErrorMessage($response, 'Username is invalid. Minimum 4 characters, maximum 16');
    return;
  }

  $passwordLength = strlen($_POST['password']);
  if($passwordLength < 4 || $passwordLength > 32){
    printErrorMessage($response, 'Password is invalid. Minimum 4 characters, maximum 32');
    return;
  }
  /**
   *  End verify valid POST arguments
   */




  // Create arguments. Acess database to get the User.
  $database = new Database;
  $username = $_POST['username'];
  $password = $_POST['password'];



  switch($_POST['functionName']) {
    case 'login':
      //Verify correct username

      $loginStatus = $database->checkValidLogin($username,$password);
      if ($loginStatus == false){
        printErrorMessage($response, 'Invalid username or password!');
        return;
      }

      // CLEAN USER SESSION
      session_start();
      session_unset();
      session_destroy();

      //INITIALIZE NEW SESSION
      $session = new Session;
      
      $userID = $database->getUserID($username);
      $session->activateSession($userID, $username);

      $response['message'] = 'Logged in successfully';
      break;

    case 'register':
      $verifyPassword = $_POST['verifyPassword'];
      $email = $_POST['email'];
      $registerStatus = $database->checkValidRegister($username,$password,$verifyPassword,$email);

      if(!is_bool($registerStatus)){
        printErrorMessage($response, $registerStatus);
        return;
      }

      $database->insertUser($username,$email,$password);
      $response['message'] = 'Registered successfully';
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