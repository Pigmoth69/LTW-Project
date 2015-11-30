$(document).ready(onReady);
this.counter=1;


function onReady() {
	
    setInterval(function () {
        makeSlide();
    }, 3500);
}; 


function makeSlide(){
	if(this.counter > 4 || this.counter <-1)
		this.counter=0;
	
	switch(this.counter){
		case 0:
			$('#slider5').css('display','none');
			$('#slider1').css('display','block');
			counter++;
			break;
		case 1:
			$('#slider1').css('display','none');
			$('#slider2').css('display','block');
			counter++;
			break;
		case 2:
			$('#slider2').css('display','none');
			$('#slider3').css('display','block');
			counter++;
			break;
		case 3:
			$('#slider3').css('display','none');
			$('#slider4').css('display','block');
			counter++;
			break;
		case 4:
			$('#slider4').css('display','none');
			$('#slider5').css('display','block');
			counter++;
			break;
		default:
	}
		/*var $target = $($(this).attr('href')),
            $other = $target.siblings('.active');
        
        if (!$target.hasClass('active')) {
            $other.each(function(index, self) {
                var $this = $(this);
                $this.removeClass('active').animate({
                    left: $this.width()
                }, 500);
            });

            $target.addClass('active').show().css({
                left: -($target.width())
            }).animate({
                left: 0
            }, 500);
        }*/
}
