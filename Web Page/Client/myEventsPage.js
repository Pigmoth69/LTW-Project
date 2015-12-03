$(document).ready(onReady);

function onReady() {
	$('#portfolio input').click(onButtonClick);

};

function onButtonClick(event) {
	var eventID = $(this).attr('eventID');


	window.document.location.href = '../Pages/event?id=' + eventID
}