$(document).ready(onReady);

function onReady() {
	$('#portfolio input').click(onButtonClick);

};

function onButtonClick(event) {
	var userID = $(this).attr('userID');
	if($(this).val() == 'Checkout')
		window.document.location.href = '../Pages/profilePage.php?id=' + userID; //Send GET request to page.
}
