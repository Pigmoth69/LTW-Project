$(document).ready(onReady);
this.open = true;

function onReady() {
	startForm();

	if($('#userID').val() != $('#userIDLink').val())
		$('#editInfo').hide();

	$('input#editInfo').click(onButtonClick);
	$('input#deleteAccount').click(deleteAccount);
 
	if($('#userID').val() == $('#userIDLink').val())
	$('#editInfoForm').submit( function( e ) {
    $.ajax( {
      url: '../Server/editUserInfo.php',
      type: 'POST',
      data: new FormData( this ),
      processData: false,
      contentType: false,
      success: function(response) {
      			showValidation(response);
            }

    } );
    e.preventDefault();
  } );

};

function startForm(){
	$('.editInfoForm').hide();
	$('div#message').hide();
	$('div#deleteMessage').hide();
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

function showValidation(data) {
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

function deleteAccount(){
	if(!confirm('Deleting your account is irreversible. Are you sure you wish to delete your account?') )
		return;

	$.post(
    '../Server/deleteAccount.php',
	{ }, 
	function (data) {
		showDeleteValidation(data);
		if(data['error'] == null){
			setTimeout(function(){window.document.location.href = '../Pages/LoginRegisterPage.php';}, 1000);
			return;
		}
			
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });
}

function showDeleteValidation(data) {
	$('#deleteMessage').show();

	if (data['error'] != null)
		{
			$('#deleteMessage').css('background-color','#ff6666');
			$('#deleteMessage').html(data['error']);
		}
	else
		{
			$('#deleteMessage').css('background-color','#99ff99');
			$('#deleteMessage').html(data['message']);
		}
}

