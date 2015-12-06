$(document).ready(onReady);
this.open = true;

function onReady() {
	startForm();

	if($('#userID').val() != $('#userIDLink').val())
		$('#editInfo').hide();

	$('input#editInfo').click(function() {onButtonClick(); });
	$('input#deleteProfile').click(function(){deleteUser();})
 
	if($('#userID').val() == $('#userIDLink').val())
	$('#editInfoForm').submit( function( e ) {
    $.ajax( {
      url: '../Server/editUserInfo.php',
      type: 'POST',
      data: new FormData( this ),
      processData: false,
      contentType: false,
      success: function(response) {
      			showInputValidation(response);
            }

    } );
    e.preventDefault();
  } );

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

function deleteUser(){
	if(!confirm('Are you sure you wish to delete your profile?') )
		return;

	$.post(
    '../Server/deleteUser.php',
	{ }, 
	function (data) {
		showValidation(data);
		if(data['error'] == null)
			setTimeout(function(){window.document.location.href = '../Pages/myEventsPage.php';}, 1000);
			
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });
}


