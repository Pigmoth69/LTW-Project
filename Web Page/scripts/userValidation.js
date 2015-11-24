$(document).ready(onReady);

function onReady() {
	updateLoginForm();
	$('#login').click(updateLoginForm);
	$('#register').click(updateLoginForm);

	$('#submitLog').click(onButtonClick);
	$('#submitReg').click(onButtonClick);

	$('#validationForm').submit(
		function(event) {
		onFormSubmission(event);
	}
	);

};

function updateLoginForm() {
	if ($('#login').is(':checked')){
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
		'functionName': 'login', 
		'username': username,
		'password': password
	}, 
	function (data) {
				console.log("Hello2");
                alert("Hello3");
                alert(data);
                console.log(data);
    })
    .fail(function (error) {
            alert("Sim");
            alert(error.html);
        });

}

function register() {
	alert("Registering...");
	//Create database entry if information is valid.
}
