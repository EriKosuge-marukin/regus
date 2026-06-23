var pullDownTimer=0;
$(document).ready(function(){
initRollovers();
showDetail();
});


/* ----------
easy Rollover
-------------------------------------------------- */
function initRollovers(){
	if (!document.getElementById) return
	
	var aPreLoad = new Array();
	var sTempSrc;
	var aImages = document.getElementsByTagName('img');

	for (var i = 0; i < aImages.length; i++) {		
		if (aImages[i].className == 'over') {
			var src = aImages[i].getAttribute('src');
			var ftype = src.substring(src.lastIndexOf('.'), src.length);
			var hsrc = src.replace(ftype, '_o'+ftype);

			aImages[i].setAttribute('hsrc', hsrc);
			
			aPreLoad[i] = new Image();
			aPreLoad[i].src = hsrc;
			
			aImages[i].onmouseover = function() {
				sTempSrc = this.getAttribute('src');
				this.setAttribute('src', this.getAttribute('hsrc'));
			}	
			
			aImages[i].onmouseout = function() {
				if (!sTempSrc) sTempSrc = this.getAttribute('src').replace('_o'+ftype, ftype);
				this.setAttribute('src', sTempSrc);
			}
		}
	}
};

/* ----------
Left Link Toggle
-------------------------------------------------- */

function showDetail(){
 $('.areaGuide dd').each(
  function(){
   $(this).hide();
  }
 );
 $('.areaGuide dt').toggle(
  function(){
   $(this).next().slideDown();
  },
  function(){
   $(this).next().slideUp();
  }
 );
$('.areaGuide dt').mouseover(
		function(){
			$(this).css('opacity','0.7');
		}
);
$('.areaGuide dt').mouseout(
		function(){
			$(this).css('opacity','1');
		}
	);
};


/* ----------
Gnav responsive
-------------------------------------------------- */


$(function() {
$('#gmenuBtn').click(function() {
	 $(this).toggleClass("op");
  $('#gNav').slideToggle('normal', function() {
  });
});
});


/* ----------
Hero Carousel Slider
------------------------------------*/
$(document).ready(function(){ 
	$("#indexSlide").carouFredSel({
		width:"100%",
		align:"left",
		items: {
			width: 240,
			height: 274,
			visible: 4,
			minimum: 1
		},
		scroll: {
			items: 1,
			duration: 800,
			pauseOnHover:true
		},
		auto: {
			pauseDuration: 8000,
		},
swipe: {
onTouch:true,
onMouse:true,
},
		next: {
			button: "#slideNext",
			items: 1
		},
		prev: {
			button: "#slidePrev",
			items: 1
		},
		pagination: "#pagerArea",
	});
});

$(document).ready(function(){
$(".crslImg li:even").css("background-color", "#002f6d");
});


/*----------*/
$(function(){
$("#toTop a").click(function(){
$('html,body').animate({ scrollTop: $($(this).attr("href")).offset().top }, 'slow','swing');
return false;
})
});



$(document).ready(function(){
$(".inline").colorbox({inline:true, width:"100%"});
$(this).colorbox.close;
});


