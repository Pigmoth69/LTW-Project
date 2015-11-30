$(document).ready(onReady);

function onReady() {
	startForms();

	$('#LoginButton').click(function() {switchPanel('login');});
	$('#RegisterButton').click(function() {switchPanel('register'); });

	$('#submitLog').click(function() {onButtonClick('login'); });
	$('#submitReg').click(function() {onButtonClick('register'); });

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
	/*que objetivo tem esta condiçao?*/
	if(button == 'login')
		$('#acessType').val('login');
	else if(button == 'register')
		$('#acessType').val('register');

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
    '../server/validateCredentials.php',
	{
		"functionName": 'login', 
		"username": username,
		"password": password
	}, 
	function (data) {
		if(data['error'] != null){
			$('div#message').show();
			$('div#message').html(data['error']);
		}
		else {
			$('div#message').hide();
			window.document.location.href = '../pages/mainPage.html';
		}
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
    '../server/validateCredentials.php',
	{
		'functionName': 'register', 
		'username': username,
		'password': password,
		'verifyPassword': verifyPassword,
		'email': email
	}, 
	function (data) {
		$('div#message').show();
		$('div#message').html(data['error']);
	})
    .fail(function (error) {
        console.log("Error: " + error);
    });
}
