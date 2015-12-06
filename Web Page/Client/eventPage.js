$(document).ready(onReady);

function onReady() {
	$('#message').hide();

	//startButtons();
	var following = $('#following').val();


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

	$('#leave').click(onLeaveClick);
	$('#edit').click(onEditClick);
	$('#delete').click(onDeleteClick);
	$('#join').click(onJoinClick);
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
		showValidation(data);
		if(data['error'] == null)
			setTimeout(function(){window.document.location.href = '../Pages/myEventsPage.php';}, 1000);
			
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });
}

function onEditClick(event) {
	var eventID = $('#eventID').val();
	
	$.post(
    '../Server/manageEvent.php',
	{ 
		"functionName" : 'edit',
		"eventID": eventID
	}, 
	function (data) {
		showValidation(data);
		if(data['error'] == null){
			return;
		}			
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });
}

function onDeleteClick(event) {
	if(!confirm('Deleting an event is irreversible. Are you sure you wish to delete this event?') )
		return;

	var eventID = $('#eventID').val();
	
	$.post(
    '../Server/manageEvent.php',
	{ 
		"functionName" : 'delete',
		"eventID": eventID
	}, 
	function (data) {
		showValidation(data);
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
		showValidation(data);
		if(data['error'] == null)
			setTimeout(function(){window.document.location.href = '../Pages/myEventsPage.php';}, 1000);
			
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });
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

function startButtons() {
	var eventID = $('#eventID').val();
	
	//Check if user is following event and can leave or if is a stranger and can join
	$.post(
    '../Server/checkIfFollowing.php',
	{ 
		"eventID": eventID
	}, 
	function (data) {
		if(data['error'] != null){
			alert(data['error']);
			return;
		}

		if(data['message'] == null || data['message'] == ""){
			alert('Oops, something went wrong!! Going back to your events.');
			setTimeout(function(){window.document.location.href = '../Pages/myEventsPage.php';}, 100);
			return;
		}

		if(data['message'] == 'Follower'){
			$('#leave').show();
			$('#join').hide();
		}
		else if(data['message'] == 'Stranger'){
			$('#leave').hide();
			$('#join').show();
		}
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });


    //Check if user is host and can edit/delete or if is guest and can leave
	$.post(
    '../Server/checkIfHost.php',
	{ 
		"eventID": eventID
	}, 
	function (data) {
		if(data['error'] != null){
			alert(data['error']);
			return;
		}

		if(data['message'] == null || data['message'] == ""){
			alert('Oops, something went wrong!! Going back to your events.');
			setTimeout(function(){window.document.location.href = '../Pages/myEventsPage.php';}, 100);
			return;
		}

		if(data['message'] == 'Host'){
			$('#join').hide();
			$('#leave').hide();
			$('#edit').show();
			$('#delete').show();
		}
		else if(data['message'] == 'Guest'){
			$('#edit').hide();
			$('#delete').hide();
		}
	})
    .fail(function (error) {
        console.error("Error: " + error);
    });

}
