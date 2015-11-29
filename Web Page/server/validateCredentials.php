 <?php
  header('Content-Type: application/json');
  include_once('Database.php');

  $response = array();

  /**
   *	Verify valid POST arguments
   */
  if( $_POST['functionName'] == "" ) {
  	$response['error'] = 'No function name!';
	  echo json_encode($response);
	  return;
	}

  if( $_POST['username'] == "" ) {
  	$response['error'] = 'No username argument!';
	  echo json_encode($response);
	  return;
	}

  if( $_POST['password'] == "" ) {
  	$response['error'] = 'No password argument!';
	  echo json_encode($response);
	  return;
	}
  

  $usernameLength = strlen($_POST['username']);

  if($usernameLength < 4 || $usernameLength > 16){
    $response['error'] = 'Username is invalid. Minimum 4 characters, maximum 16';
    echo json_encode($response);
    return;
  }


  $passwordLength = strlen($_POST['password']);

  if($passwordLength < 4 || $passwordLength > 16){
    $response['error'] = 'Password is invalid. Minimum 4 characters, maximum 16';
    echo json_encode($response);
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
      $response['error'] = 'Invalid username or password!';
      echo json_encode($response);
      return;
    }

    $response['message'] = 'Logged in successfully';
    break;

    case 'register':

    $verifyPassword = $_POST['verifyPassword'];
    $email = $_POST['email'];
    $registerStatus = $database->checkValidRegister($username,$password,$verifyPassword,$email);

    if(!is_bool($registerStatus)){
      $response['error'] = $registerStatus;
      echo json_encode($response);
      return;
    }

    $database->insertUser($username,$email,$password);
    $response['message'] = 'Registered successfully';
    break;

    default:
    $response['error'] = 'Could not find the function '.$_POST['functionName'].'!';
    break;
  }

  echo json_encode($response);
  ?>