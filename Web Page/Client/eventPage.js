$(document).ready(onReady);
this.editOpen = true;

function onReady() {
	$('#message').hide();
	$('#message1').hide();
	var following = $('#following').val();
	$('.editInfoForm').hide();
	if($('#userID').val() != $('#hostID').val())
	{
		$('#delete').hide();
		$('#edit').hide();

		if(following == "1")
			$('#join').hide();
		else $('#leave').hide();
	}
	else {
		$('#join').hide();
		$('#leave').hide();
	}

	$('#edit').click(onEditClick);
	$('#leave').click(onLeaveClick);
	$('#delete').click(onDeleteClick);
	$('#join').click(onJoinClick);

	$('#editInfoForm').submit( function( e ) {
    $.ajax( {
      url: '../Server/editEventInfo.php',
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

function onLeaveClick(event) {
	if(!confirm('Are you sure you wish to leave the event?') )
		return;

	var eventID = $('#eventID').val();
	
	$.post(
    '../Server/manageEvent.php',
	{ 
		"functionName" : 'leave',
		"eventID": eventID
	}, 
	function (data) {
		showInputValidation1(data);
		if(data['error'] == null)
			setTimeout(function(){window.document.location.href = '../Pages/myEventsPage.php';}, 1000);
			
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });
}

function onEditClick(event) {
	if(!this.open)
	{
		$('#edit').css('box-shadow', '0px 0px 10px #feff00');
		$('.editInfoForm').show();
		this.open = true;
	}
	else
	{
		$('#edit').css('box-shadow', 'none');
		$('.editInfoForm').hide();
		this.open = false;
		clearForm();
	}
}

function onDeleteClick(event) {
	if(!confirm('Deleting an event is irreversible. Are you sure you wish to delete this event?') )
		return;

	var eventID = $('#eventID').val();
	console.log(eventID);
	$.post(
    '../Server/manageEvent.php',
	{ 
		"functionName" : 'delete',
		"eventID": eventID
	}, 
	function (data) {
		showInputValidation1(data);
		if(data['error'] == null)
			setTimeout(function(){window.document.location.href = '../Pages/myEventsPage.php';}, 1000);
			
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });
}

function onJoinClick(event) {
	if(!confirm('Are you sure you wish to join the event?') )
		return;

	var eventID = $('#eventID').val();

	
	$.post(
    '../Server/manageEvent.php',
	{ 
		"functionName" : 'join',
		"eventID": eventID
	}, 
	function (data) {
		showInputValidation1(data);
		if(data['error'] == null)
			setTimeout(function(){window.document.location.href = '../Pages/myEventsPage.php';}, 1000);
			
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });
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

function showInputValidation1(data) {
	$('#message1').show();

	if (data['error'] != null)
	{
		$('#message1').css('background-color','#ff6666');
		$('#message1').html(data['error']);
	}
	else
	{
		$('#message1').css('background-color','#99ff99');
		$('#message1').html(data['success']);
	}
}




function clearForm(){
	$('#name').val("");
	$('#photo').val("");
	$('#editdescription').val("");
	$('#location').val("");
	$('#date').val("");
}


