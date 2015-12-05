$(document).ready(onReady);
this.open = true;

function onReady() {
	startForm();

	$('input#editInfo').click(function() {onButtonClick(); });

	$('.editInfoForm').submit(
		function(event) {
		event.preventDefault();
		onFormSubmission(event); 
	}
	);

};

function startForm(){
	$('.editInfoForm').hide();
	$('div#message').hide();
};

function onButtonClick() {
		if(this.open)
		{
			$('#editInfo').css('box-shadow', '0px 0px 10px #feff00');
			$('.editInfoForm').show();
			this.open = false;
		}
		else
		{
			$('#editInfo').css('box-shadow', 'none');
			$('.editInfoForm').hide();
			this.open = true;
			clearForm();
		}
}

function clearForm() {
	$('#fullname').val("");
	$('#photo').val("");
	$('#password').val("");
	$('#verifyPassword').val("");
	$('#email').val("");
	$('#date').val("");
	$('div#message').hide();
}

function onFormSubmission(event) {
	var fullname = $('#fullname').val()
	var photo = $('#photo').val();
	var password = $('#password').val();
	var verifyPassword = $('#verifyPassword').val();
	var email = $('#email').val();
	var date = $('#date').val();

	$.post(
    '../Server/editUserInfo.php',
    {
		'fullname': fullname, 
		'photo': photo,
		'password': password,
		'verifyPassword': verifyPassword,
		'email': email,
		'date': date,
	}, 
	function (data) {
		showInputValidation(data);
		console.log(data);
	})
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
			$('#message').html(data['success']);
		}
}