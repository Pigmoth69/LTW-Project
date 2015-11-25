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

  if( !isset($response['error']) ) {

   	switch($_POST['functionName']) {
      case 'login':
        $response['username'] = $_POST['username'];
        $response['password'] = $_POST['password'];
        break;

      case 'register':
        if( !isset($_POST['verifyPassword']) ) {
          $response['error'] = 'No verifyPassword argument!';
          echo json_encode($response);
          return;
          }

        if( !isset($_POST['email']) ) {
          $response['error'] = 'No email argument!';
          echo json_encode($response);
          return;
          }

        $response['username'] = $_POST['username'];
        $response['password'] = $_POST['password'];
        $response['verifyPassword'] = $_POST['verifyPassword'];
        $response['email'] = $_POST['email'];
        break;
      
      default:
       	$response['error'] = 'Could not find the function '.$_POST['functionName'].'!';
       	break;
      }
  }

    echo json_encode($response);
?>