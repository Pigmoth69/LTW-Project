$(document).ready(onReady);


function onReady() {
	$('#testButton').click(onButtonClick);

	$('#testForm').submit(
		function(event) {
		console.log("Called");
		event.preventDefault();
		onFormSubmission(event);
	}
	);

};

function onButtonClick() {
	$('#testForm').submit();
}

function onFormSubmission(event) {
	console.log($.session['login']);
}