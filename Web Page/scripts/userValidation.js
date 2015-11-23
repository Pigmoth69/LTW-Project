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
		$('#emailLabel').hide();
		$('#emailLabel').next().hide();

		$('#email').hide();
		$('#email').next().hide();

		$('#verEmailLabel').hide();
		$('#verEmailLabel').next().hide();

		$('#verifyEmail').hide();
		$('#verifyEmail').next().hide();

		$('#submitLog').show();
		$('#submitReg').hide();

	 }
	else if($('#register').is(':checked')){
		$('#emailLabel').show();
		$('#emailLabel').next().show();

		$('#email').show();
		$('#email').next().show();

		$('#verEmailLabel').show();
		$('#verEmailLabel').next().show();

		$('#verifyEmail').show();
		$('#verifyEmail').next().show();

		$('#submitLog').hide();
		$('#submitReg').show();
	}
}

function onButtonClick() {
	$('#validationForm').submit();
}

function onFormSubmission(event) {
	alert("Ola");
}
