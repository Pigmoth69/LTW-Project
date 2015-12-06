$(document).ready(onReady);

function onReady() {


	changeStateCancel();
	$('#portfolio input').click(onButtonClick);
	$('#createButton').click(changeStateCreate);
	$('#cancelButton').click(changeStateCancel);
	$("#eventImage").change(function(){
		readURL(this);
	});

	$('#addEvent').submit( function(e) {
		$.ajax( {
			url: '../Server/createEvent.php',
			type: 'POST',
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(response) {
				showInputValidation(response);
			}

		} );
		e.preventDefault();
	} );
}

function onButtonClick(event) {
	var eventID = $(this).attr('eventID');
	if($(this).val() == 'Checkout')
		window.document.location.href = '../Pages/eventPage.php?id=' + eventID; //Send GET request to page.
}

function changeStateCreate(){
	$('#CreateEvent').hide();
	$('#CancelEvent').show();
	$('#addEvent').show();


}

function changeStateCancel(){
	$('#CreateEvent').show();
	$('#CancelEvent').hide();
	$('#addEvent').hide();
	clearForm();
}


function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


function clearForm(){
	$('#preview').attr("src","../Resources/Images/empty.jpg");
	$('#preview').val("");
	$('#eventName').val("");
	$('#eventType').val("Birthday");
	$('#eventLocation').val("");
	$('#eventDescription').val("");
	$('#eventDate').val(null);
	$('#eventPrivacy').val("Public");
	$('#message').hide();
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