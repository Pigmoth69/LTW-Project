 <?php

  header('Content-Type: application/json');
  $f = fopen('data.txt', 'w');
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


  // Create arguments. Acess database to get the User.
  $username = $_POST['username'];
  $password = $_POST['password'];


  $db = new PDO('sqlite:../Database/database.db');
  $stmt = $db->prepare('SELECT * FROM User WHERE username = :username');
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $users = $stmt->fetchAll();

  switch($_POST['functionName']) {
      case 'login':
      	//Verify correct username
      	if ($users == NULL){
      		$response['error'] = 'No user with that username';
      		echo json_encode($response);
      		return;
      	}
      	//Verify Correct Password
        $dbPassword = $users[0][3];
        
		    if(!password_verify($password, $dbPassword)) {
            $response['error'] = 'Password Invalid';
            echo json_encode($response);
            return;
        }

		    $response['message'] = 'Logged in successfully';
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

        
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $response['error'] = 'Invalid e-mail!';
          echo json_encode($response);
          return;
        }

        //All inputs valid. Check if email is unique.
        $stmt = $db->prepare('SELECT email FROM User Where email == :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $duplicateEmails = $stmt->fetchAll();

        if($duplicateEmails != NULL){
          $response['error'] = 'Email taken. You may only have one account per e-mail.';
          echo json_encode($response);
          return;
        }

        //All clear, creare new database Entry
        $dbPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $db->prepare('INSERT INTO User(username, email, password) VALUES (:username, :email, :password)');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $dbPassword, PDO::PARAM_STR);
        $stmt->execute();

        $response['message'] = 'Registered successfully';

        break;

      default:
       	$response['error'] = 'Could not find the function '.$_POST['functionName'].'!';
       	break;
      }

    echo json_encode($response);
?>