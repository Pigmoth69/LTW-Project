 <?php
    header('Content-Type: application/json');

    $response = array();

    if( !isset($_POST['functionname']) ) { $response['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $response['error'] = 'No function arguments!'; }

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
               	$response['error'] = 'Not found function '.$_POST['functionname'].'!';
               	break;
        }

    }

    echo json_encode($response);


?>