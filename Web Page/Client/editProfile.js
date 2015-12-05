$(document).ready(onReady);
this.open = true;

function onReady() {
	startForm();

	$('input#editInfo').click(function() {onButtonClick(); });

/*	$('#editInfoForm').submit(
		function(event) {
		event.preventDefault();
		onFormSubmission(event); 
	}
	);
*/

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

function onFormSubmission(event) {
    

    //var filedata = $("form#editInfoForm")[0];
    //formData = new FormData();
    //formData.append("fullname", $('fullname')[0]);
    //formData.append("photo", $("#photo")[0].files[0]);
    //console.log(formData);

    /*
    var i = 0, len = filedata.files.length;
    
    for (var i = 0; i < len; i++) {
        var file = filedata.files[i];
        formData.append("file" + i, file);
    }
    formData.append('nrfiles', filedata.files.length);
    formData.append('eventId', parseInt(getUrlParameter("id")));
    */
    
    /*$.ajax({
        type: "post",
        url: "../Server/editUserInfo.php",
        data: {'fullname' : 1},
        processData: false,
        contentType: false,
        success: function(response) {
            showInputValidation(response);
        },
        error: function(errResponse) {
            console.log(errResponse);
        }
    });*/
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
