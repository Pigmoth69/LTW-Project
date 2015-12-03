$(document).ready(onReady);

function onReady() {
	$('#portfolio input').click(onButtonClick);

};

function onButtonClick(event) {
	var eventID = $(this).attr('eventID');
	if($(this).val() == 'Checkout')
		window.document.location.href = '../Pages/event?id=' + eventID; //Send GET request to page.
}
