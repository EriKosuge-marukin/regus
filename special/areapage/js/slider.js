$(document).ready(function(){
	var huga = $(".slider").bxSlider({
		auto: true,
		pause: 5000,
		controls:false,
		slideWidth: 767,
		onSlideAfter: function(){
			huga.startAuto();
		}
	});
});
