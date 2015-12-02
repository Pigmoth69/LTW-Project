$(document).ready(onReady);

function onReady() {
	$('#portfolio input').click(onButtonClick);

};

function onButtonClick(event) {
	var eventID = $(this).attr('eventID');
	console.log()

	$.post(
    '../Server/addUserToEvent.php',
	{
		"functionName": 'addUserToEvent', 
		"eventID": eventID
	}, 
	function (data) {
		if(data['error'] != null){
			console.log('Deu merda');
			return;
		}

		console.log(data['message']);

	})
    .fail(function (error) {
        alert(error['message']);
    });
}