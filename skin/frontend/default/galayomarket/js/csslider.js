;(function ($) {
	/FlexSlider: Object Instance
	$.csslider = function(el, options) {
		var slider = $(el),
        vars = $.extend({}, $.csslider.defaults, options),
        touch = ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch,
        eventType = (touch) ? "touchend" : "click",
        vertical = vars.direction === "vertical";
		
		// Store a reference to the slider object
		$.data(el, "csslider", slider);
		
		$.csslider.defaults = {
			selector : ".slides > li.itemslider",
			move : 1,
			minItems : 1,
			speed : 500
		}
		
		slider.init = function (){
			
		}
	}
})(jQuery);