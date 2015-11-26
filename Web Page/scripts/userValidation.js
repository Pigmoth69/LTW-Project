$(document).ready(onReady);


function onReady() {
	startForms();
	$('#LoginButton').click(switchLogin);
	$('#RegisterButton').click(switchRegister);
	/*updateLoginForm();
	$('#LoginButton').click(updateLoginForm);
	$('#RegisterButton').click(updateLoginForm);
	$('#submitLog').click(onButtonClick);
	$('#submitReg').click(onButtonClick);*/

	/*$('#validationForm').submit(
		function(event) {
		event.preventDefault();
		onFormSubmission(event); 
	}
	);*/

};

function startForms(){
	$('#LoginButton').css('background-color','green');
	$('#RegisterButton').css('background-color','#76A9C5');

	$('#verifyPassword').hide();
	$('#verifyPassword').next().hide();

	$('#email').hide();
	$('#email').next().hide();

	$('#submitLog').show();
	$('#submitReg').hide();
}

function switchLogin(){
	$(this).css('background-color','green');
	$('#RegisterButton').css('background-color','#76A9C5');

	$('#verifyPassword').hide();
	$('#verifyPassword').next().hide();

	$('#email').hide();
	$('#email').next().hide();

	$('#submitLog').show();
	$('#submitReg').hide();
}

function switchRegister(){
	$(this).css('background-color','green');
	$('#LoginButton').css('background-color','#76A9C5');

	$('#verifyPassword').show();
	$('#verifyPassword').next().show();

	$('#email').show();
	$('#email').next().show();

	$('#submitLog').hide();
	$('#submitReg').show();
}




function updateLoginForm() {
	if ($('#LoginButton').is(':checked')){
		$('#verPassLabel').hide();
		$('#verPassLabel').next().hide();

		$('#verifyPassword').hide();
		$('#verifyPassword').next().hide();

		$('#emailLabel').hide();
		$('#emailLabel').next().hide();

		$('#email').hide();
		$('#email').next().hide();

		$('#submitLog').show();
		$('#submitReg').hide();

	 }
	else if($('#register').is(':checked')){
		$('#verPassLabel').show();
		$('#verPassLabel').next().show();

		$('#verifyPassword').show();
		$('#verifyPassword').next().show();

		$('#emailLabel').show();
		$('#emailLabel').next().show();

		$('#email').show();
		$('#email').next().show();

		$('#submitLog').hide();
		$('#submitReg').show();
	}
}

function onButtonClick() {
	$('#validationForm').submit();
}

function onFormSubmission(event) {
	if ($('#login').is(':checked'))
		logIn();

	else if ($('#register').is(':checked'))
		register();
}

function logIn() {
	var username = $('#username').val();
	var password = $('#password').val();

	$.post(
    'scripts/validateLoginCredentials.php',
	{
		"functionName": 'login', 
		"username": username,
		"password": password
	}, 
	function (data) {
		alert("Username: " + data['username']);
		alert("Password: " + data['password']);
		alert("Error: " + data['error']);		
    })
    .fail(function (error) {
    	console.log("called");
        alert(error);
    });

}

function register() {
	alert("Registering...");
	//Create database entry if information is valid.
}
