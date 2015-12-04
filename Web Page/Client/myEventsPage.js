$(document).ready(onReady);

function onReady() {
	$('#portfolio input').click(onButtonClick);
	$('#createButton').click(changeStateCreate);
	$('#cancelButton').click(changeStateCancel);
	$("#eventImage").change(function(){
    readURL(this);
});

};

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