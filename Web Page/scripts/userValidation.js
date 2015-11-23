$(document).ready(onReady);

function changeLoginForm() {
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

function onReady() {
	changeLoginForm();
	$('#login').click(changeLoginForm);
	$('#register').click(changeLoginForm);
};

function onFormSubmit() {
	
}