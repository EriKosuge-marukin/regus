/* -----------------------------------------

 jquery.scroller.d5.js
 v1.0
 
 DAICHIFIVE
 http://www.daichifive.com/
 
------------------------------------------*/
(function(jQuery) {
	jQuery.fn.scRoller = function() {
		return this.each(function() {
			jQuery(this).click(function() {
				jQuery('html,body').animate({
					scrollTop: jQuery(jQuery(this).attr("href")).offset().top
				});
				return false;
			});
		});
	};
})(jQuery);

jQuery(function(){
	jQuery("a[href^=#]").scRoller();
});