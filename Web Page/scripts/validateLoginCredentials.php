 <?php
  header('Content-Type: application/json');

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


  // Create arguments. Acess database for username
  $username = $_POST['username'];
  $password = $_POST['password'];

  $db = new PDO('sqlite:../Database/database.db');
  $stmt = $db->prepare('SELECT * FROM User WHERE name == :username');
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $users = $stmt->fetchAll(); //Hopefully there is only one user.

  switch($_POST['functionName']) {
      case 'login':
      	//Verify correct username
      	if ($users == NULL){
      		$response['error'] = 'No user with that username';
      		echo json_encode($response);
      		return;
      	}
      	//Verify Correct Password
      	$dbPassword = password_hash($users[0][6], PASSWORD_BCRYPT);
		if(!password_verify($password, $dbPassword)){
			$response['error'] = 'Password Invalid';
			echo json_encode($response);
			return;
		}

		$response['username'] = $username;
		$response['password'] = $password;
        break;

      case 'register':
      	if($users != NULL){
      		$response['error'] = 'Username taken. Please choose a different username.';
      		echo json_encode($response);
      	}

        if($_POST['verifyPassword'] == "") {
          $response['error'] = 'No verifyPassword argument!';
          echo json_encode($response);
          return;
         }

        if($_POST['email'] == "") {
          $response['error'] = 'No email argument!';
          echo json_encode($response);
          return;
        }

        $verifyPassword =  $_POST['verifyPassword'];
        if($verifyPassword != $password){
          $response['error'] = 'Password mismatch!';
          echo json_encode($response);
          return;
        }

        $response['verifyPassword'] = $verifyPassword;
        
        $email = $_POST['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $response['error'] = 'Invalid e-mail!';
          echo json_encode($response);
          return;
        }
        
        $response['email'] = $email;
        break;

      default:
       	$response['error'] = 'Could not find the function '.$_POST['functionName'].'!';
       	break;
      }

    echo json_encode($response);
?>