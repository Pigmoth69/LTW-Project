$(document).ready(onReady);

function onReady() {
	startForms();

	$('#LoginButton').click(function() {switchPanel('login');});
	$('#RegisterButton').click(function() {switchPanel('register'); });

	$('#submitLog').click(function() {onButtonClick('login'); });
	$('#submitReg').click(function() {onButtonClick('register'); });

	$('#validationForm').keypress(function( event ) {onKeyPressed(event) });

	$('#validationForm').submit(
		function(event) {
		event.preventDefault();
		onFormSubmission(event); 
	}
	);

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

	$('#message').hide();
}

function switchPanel(button){

	$('input#username').val("");
	$('input#password').val("");

	$('#message').hide();

	if(button == 'login'){
		$('#LoginButton').css('background-color','green');
		$('#RegisterButton').css('background-color','#76A9C5');


		$('#verifyPassword').hide();
		$('#verifyPassword').next().hide();

		$('#email').hide();
		$('#email').next().hide();

		$('#submitLog').show();
		$('#submitReg').hide();
	}
	else if (button == 'register'){
		$('#RegisterButton').css('background-color','green');
		$('#LoginButton').css('background-color','#76A9C5');
		
		$('#verifyPassword').val("");
		$('#verifyPassword').show();
		$('#verifyPassword').next().show();

		$('#email').val("");
		$('#email').show();
		$('#email').next().show();

		$('#submitLog').hide();
		$('#submitReg').show();
	}

}

function onButtonClick(button) {
	$('#acessType').val(button);

	$('#validationForm').submit();
}

function onKeyPressed(event) {
	if ( event.which == 13 ) 
		$('#validationForm').submit();
}

function onFormSubmission(event) {
	if ($('#acessType').val() == 'login')
		logIn();

	else if ($('#acessType').val() == 'register')
		register();
}

function logIn() {
	var username = $('#username').val();
	var password = $('#password').val();

	$.post(
    '../Server/validateCredentials.php',
	{
		"functionName": 'login', 
		"username": username,
		"password": password
	}, 
	function (data) {
		showInputValidation(data);
		if(data['error'] == null)
			window.document.location.href = '../Pages/mainPage.php';
	})
    .fail(function (error) {
        alert(error);
    });

}

function register() {
	var username = $('#username').val();
	var password = $('#password').val();
	var verifyPassword = $('#verifyPassword').val();
	var email = $('#email').val();

	$.post(
    '../Server/validateCredentials.php',
	{
		'functionName': 'register', 
		'username': username,
		'password': password,
		'verifyPassword': verifyPassword,
		'email': email
	}, 
	function (data) {
		showInputValidation(data);
	})
    .fail(function (error) {
        console.log("Error: " + error);
    });
}

function showInputValidation(data) {
	$('#message').show();

	if (data['error'] != null)
		{
			$('#message').css('background-color','#ff6666');
			$('#message').html(data['error']);
		}
	else
		{
			$('#message').css('background-color','#99ff99');
			$('#message').html(data['message']);
		}
}