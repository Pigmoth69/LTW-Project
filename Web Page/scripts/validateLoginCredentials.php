 <?php
  header('Content-Type: application/json');

  $response = array();

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

  $username = $_POST['username'];
  $password = $_POST['password'];
  
  switch($_POST['functionName']) {
      case 'login':
        break;

      case 'register':
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