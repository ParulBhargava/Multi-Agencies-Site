$(window).scroll(function() {
	var $height = $(window).scrollTop();
  if($height > 350) {
		$('nav').addClass('active');
	} else {
		$('nav').removeClass('active');
	}
});