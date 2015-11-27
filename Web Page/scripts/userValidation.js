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
}

function switchPanel(button){
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

		$('#verifyPassword').show();
		$('#verifyPassword').next().show();

		$('#email').show();
		$('#email').next().show();

		$('#submitLog').hide();
		$('#submitReg').show();
	}

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

function onButtonClick(button) {
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
    'scripts/validateLoginCredentials.php',
	{
		"functionName": 'login', 
		"username": username,
		"password": password
	}, 
	function (data) {
		if(data['error'] != null)
			console.log(data['error']);

		for (var element in data){
			console.log(data[element]);
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
    'scripts/validateLoginCredentials.php',
	{
		"functionName": 'register', 
		"username": username,
		"password": password,
		"verifyPassword": verifyPassword,
		"email": email
	}, 
	function (data) {
		if(data['error'] != null)
			console.log(data['error']);

		for (var element in data){
			console.log(data[element]);
		}
	})
    .fail(function (error) {
        console.log("Error: " + error);
    });
}
