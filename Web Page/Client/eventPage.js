$(document).ready(onReady);

function onReady() {
	$('#leave').click(onButtonClick);

};

function onButtonClick(event) {
	if(!confirm('Are you sure you wish to leave the event?') )
		return;
	
	//window.document.location.href = '../Pages/eventPage.php?id=' + eventID; //Send GET request to page.
	
}
