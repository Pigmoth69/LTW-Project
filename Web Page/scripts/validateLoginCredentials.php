 <?php
 	echo "Hello";
    header('Content-Type: application/json');

    $response = array();

    if( !isset($_POST['functionName']) ) {
    	$response['error'] = 'No function name!';
	    echo json_encode($response);
	    return;
	}

    if( !isset($_POST['username']) ) {
    	$response['error'] = 'No username argument!';
	    echo json_encode($response);
	    return;
	}

    if( !isset($_POST['password']) ) {
    	$response['error'] = 'No password argument!';
	    echo json_encode($response);
	    return;
	}

    if( !isset($response['error']) ) {

    	switch($_POST['functionname']) {

            case 'login':
            	if( !is_array($_POST['arguments']) || (count($_POST['arguments']) != 2) ) {
                	$response['error'] = 'Error in arguments!';
               	}
               	else {
                   	$response['username'] = $_POST['arguments'][0];
                   	$response['password'] = $_POST['arguments'][1];
               	}
               	break;

            case 'register':
            	if( !is_array($_POST['arguments']) || (count($_POST['arguments']) != 4) ) {
                	$response['error'] = 'Error in arguments! ';
               	}
               	else {
                   	$response['username'] = $_POST['arguments'][0];
                   	$response['password'] = $_POST['arguments'][1];
                   	$response['verifyPassowrd'] = $_POST['arguments'][2];
                   	$response['email'] = $_POST['arguments'][3];
                   	}
               	break;

            default:
               	$response['error'] = 'Could not find the function '.$_POST['functionname'].'!';
               	break;
        }

    }

    echo json_encode($response);


?>