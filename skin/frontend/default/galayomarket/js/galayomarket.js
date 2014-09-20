/**
 * EMThemes
 *
 * @license commercial software
 * @copyright (c) 2012 Codespot Software JSC - EMThemes.com. (http://www.emthemes.com)
 */
 //console.log(ADAPT_CONFIG);
(function($) {


if (typeof EM == 'undefined') EM = {};
if (typeof EM.tools == 'undefined') EM.tools = {};

var isMobile = /iPhone|iPod|iPad|Phone|Mobile|Android|hpwos/i.test(navigator.userAgent);
var isPhone = /iPhone|iPod|Phone|Android/i.test(navigator.userAgent);

//var isMobile = /iPhone|iPod|iPad|Phone|Mobile|Android|webOS|iPod|BlackBerry|hpwos/i.test(navigator.userAgent);
//var isPhone = /iPhone|iPod|Phone|Mobile|Android|webOS|iPod|BlackBerry/i.test(navigator.userAgent);

var domLoaded = false, 
	windowLoaded = false, 
	last_adapt_i, 
	last_adapt_width;


/**
 * Auto positioning product items in products-grid
 *
 * @param (selector/element) productsGridEl products grid element
 * @param (object) options
 * - (integer) width: width of product item
 * - (integer) spacing: spacing between 2 product items
 */
EM.tools.decorateProductsGrid = function (productsGridEl, options) {
	var $productsGridEl = $(productsGridEl);
	
	if ($productsGridEl.length == 0) return;
	
	var columnCount = Math.floor(($productsGridEl.outerWidth() + options.spacing) / (options.width + options.spacing));
	$productsGridEl.css({'position':'relative'});
	
	for (var i = 0; i < 30; i++) $('.item', $productsGridEl).removeClass('item-col-'+i);
            
	var maxHeight = 0;
	var i = 0;
	$('.item', $productsGridEl).each(function() {
		var prev = $(this).prevAll('.item-col-' + i).first();
        if(prev.length > 0){
            var top = prev.position().top + 380;
        }else{
            var top = 10;
        }
		
		$(this).addClass('item-col-'+i)
			.css({
				'position': 'absolute',
				'width': options.width + 'px',
				'left': 10 + i * (options.spacing + options.width) + 'px',
				'top': top + 'px'
			});
			
		maxHeight = Math.max(maxHeight, $(this).position().top + 380);
		
		if (++i >= columnCount) i = 0;
	});
	
	$productsGridEl.css({
		'height': maxHeight + options.spacing + 'px'
	});
};

EM.tools.decorateProductCollateralTabs = function() {
    initsliderhorizontal('#upsell-product-table .products-grid');     
	$(window).load(function() {
		$('.product-collateral').addClass('tab_content').each(function(i) {
			$(this).wrap('<div class="tabs_wrapper_details collateral_wrapper" />');
			var tabs_wrapper = $(this).parent();
			var tabs_control = $(document.createElement('ul')).addClass('tabs_control').insertBefore(this);
			
			$('.box-collateral', this).addClass('tab-item').each(function(j) {
				var id = 'box_collateral_'+i+'_'+j;
				$(this).addClass('content_'+id);
				tabs_control.append('<li><h2><a href="#'+id+'">'+$('h2', this).html()+'</a></h2></li>');
			});
			
			initToggleTabs(tabs_wrapper);
		});
		
	});
};


/**
 * Fix iPhone/iPod auto zoom-in when text fields, select boxes are focus
 */
function fixIPhoneAutoZoomWhenFocus() {
	var viewport = $('head meta[name=viewport]');
	if (viewport.length == 0) {
		$('head').append('<meta name="viewport" content="width=device-width, initial-scale=1.0"/>');
		viewport = $('head meta[name=viewport]');
	}
	
	var old_content = viewport.attr('content');
	
	function zoomDisable(){
		viewport.attr('content', old_content + ', user-scalable=0');
	}
	function zoomEnable(){
		viewport.attr('content', old_content);
	}
	
	$("input[type=text], textarea, select").mouseover(zoomDisable).mousedown(zoomEnable);
}



/**
 * Adjust elements to make it responsive
 *
 * Adjusted elements:
 * - Image of product items in products-grid scale to 100% width
 */
function responsive() {
	
	// resize products-grid's product image to full width 100% {{{
	var position = $('.products-grid .item').css('position');
	if (position != 'absolute' && position != 'fixed' && position != 'relative')
		$('.products-grid .item').css('position', 'relative');
		
	var img = $('.products-grid .item .product-image img');
	img.each(function() {
		img.data({
			'width': $(this).width(),
			'height': $(this).height()
		})
	});
	img.removeAttr('width').removeAttr('height').css('width', '100%');
	// }}}
	
	// responsive:
	// - image 
	// - custom logo on sidebar
	// - category image
	$('.sidebar img, .category-image img, .cloud-zoom-gallery img, .img-lightbox img, .img-default img,#crosssell-products-list .product-image img').each(function() {
		if (!$(this).hasClass('fluid')) {
			$(this).css({
				'max-width': $(this).width(),
				'max-height': $(this).height(),
                'width': '100%'
			});
		}
	});
}


/**
 * Function called when layout size changed by adapt.js
 */
function whenAdapt(i, width) {
	$('body').removeClass('adapt-0 adapt-1 adapt-2 adapt-3 adapt-4 adapt-5 adapt-6')
		.addClass('adapt-'+i);
		
	EM.tools.decorateProductsGrid('.category-products .products-grid', {
		width: PRODUCTSGRID_ITEM_WIDTH,
		spacing: PRODUCTSGRID_ITEM_SPACING
	});
	if (typeof em_slider!=='undefined')
        em_slider = new EM_Slider(em_slider.config);
}



/**
 * Callback function called when stylesheet is changed by adapt.js
 */
ADAPT_CONFIG.callback = function(i, width) {
	last_adapt_i = i;
	last_adapt_width = width;
	whenAdapt(last_adapt_i, last_adapt_width);
};


$(document).ready(function() {
	domLoaded = true;
	initsliderhorizontal('#upsell-product-table .products-grid');
	isMobile && fixIPhoneAutoZoomWhenFocus();	
	alternativeProductImage();    
    backToTop();    
    setupReviewLink();	
	// safari hack: remove bold in h5, .h5
	if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
		$('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6').css('font-weight', 'normal');
	}    
    if(isPhone == false){        
        setWidgetHeight();
    }    
    if($('body').viewPC()){
		toolbar();
        searchToolbar();
	}    
    initsliderhorizontal('#crosssell-products-list');
    addClassMobile();
    toogleStore();    
    toogleColorVariation();    
});

$(window).bind('load', function() {
	windowLoaded = true;
	responsive();
	whenAdapt(last_adapt_i, last_adapt_width);
    if(isMobile == true){
	   touchSwipeSlideshow();
    }	
});

$(window).bind('orientationchange', function () {
    EM.tools.decorateProductsGrid('.category-products .products-grid', {
		width: PRODUCTSGRID_ITEM_WIDTH,
		spacing: PRODUCTSGRID_ITEM_SPACING
	});
});
	
})(jQuery);

/** 
*   Back to top
**/
function backToTop(){
    // hide #back-top first
	jQuery("#back-top").hide();
	
	// fade in #back-top
	
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 100) {
			jQuery('#back-top').fadeIn();
		} else {
			jQuery('#back-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	jQuery('#back-top a').click(function () {
		jQuery('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

};

function initslidervertical($select){
	if(jQuery($select).length){
		jQuery($select).addClass("slides");
		jQuery($select).parent().csslider({direction : 'vertical'});
	}
};

function initsliderhorizontal($select){
	if(jQuery($select).length){
		jQuery($select).addClass("slides");
		jQuery($select).parent().csslider();
	}
};


/**
*   Set Widget Height
**/

function setWidgetHeight(){
    var $=jQuery;
    var $widgetHeight;
    $widgetHeight = $('ul.slide-item-list li.item').outerHeight(true) * 3 ;
	if($widgetHeight < 320){
	   $widgetHeight = 430;
	}else{
	   $widgetHeight = 500;
	}
		
    $('.cms-area-07 .box .grid_5').css('min-height',($widgetHeight+13) + 'px');
    $('.cms-area-07 .box .grid_9').css('min-height',($widgetHeight+13) + 'px');
    $('.cms-area-07 .grid_5 .box').css('min-height',($widgetHeight) + 'px');
	$('.cms-area-07 .grid_19 .grid_5 .box').css('min-height',($widgetHeight+13) + 'px');
};

function showReviewTab() {
	var $ = jQuery;
	
	//var reviewTab = $('.tabs_control li:contains(Review)');
    var reviewTab = $('.tabs_control li:contains('+ review +')');
    //var reviewTab = $('.tabs_control li h2 a').attr('href');
    var count = 0;
    
    //jQuer(li.contains().hasContent)
	if (reviewTab.size()) {
		// scroll to review tab
		$('html, body').animate({
			 scrollTop: reviewTab.offset().top
		}, 500);
		 
		 // show review tab
		reviewTab.click();
	} 
    else{
        if ($('#customer-reviews').size()) {
    		// scroll to customer review
    		$('html, body').animate({ scrollTop: $('#customer-reviews').offset().top }, 500);
    	} else {
    	   
    	   return false;
    	}
        $(".tabs_control li").each(function ()
        {
            count++;
            if(count == 3){
                $('html, body').animate({
        		 scrollTop:$(this).offset().top
                }, 500);
                $(this).click();
            }        
        }); 
    }
	return true;
};

function setupReviewLink() {
	jQuery('.r-lnk').click(function (e) {
		if (showReviewTab())
			e.preventDefault();
	});
};

function touchSwipeSlideshow(){
    jQuery('#slider').touchwipe({
		wipeLeft: function() { 
			jQuery('.nivo-prevNav').click();
		},
		wipeRight: function() { 
			jQuery('.nivo-nextNav').click();
		},
		preventDefaultEvents: false
	});
};

function persistentMenu() {
	var $ = jQuery;

	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 145 && window.freezedTopMenu) {
				$('.em_nav, .nav-container').addClass('fixed-top');
			} else {
				$('.em_nav, .nav-container').removeClass('fixed-top');
			}
		});
	});
};

/**
*   toolbar
**/
function toolbar(){
	var $ = jQuery;
	$('.show').each(function(){
		$(this).insertUl();
		$(this).selectUl();
	});
	$('.sortby').each(function(){
		$(this).insertUl();
		$(this).selectUl();
	});
};

/**
*   search by category
**/
function searchToolbar(){
	var $ = jQuery;
	$('.cat-search').each(function(){
		$(this).insertUlCategorySearch();
		$(this).selectUlCategorySearch();
	});
};

function addClassMobile(){
    if(isMobile == true){
        jQuery('body').addClass('mobile-view');
    }
};

function toogleStore(){
    if(isMobile == false){               
        var $=jQuery;
        initsliderhorizontal('#slider_storeview ul');
        $('.storediv').hide(); 
        $(".btn_storeview").click(function() {
    		store_show();        
    	});
    	
    	$(".btn_storeclose").click(function() {
    		store_hide();
    	});
    	
    	function store_show(){            
    		var bg	=	$("#bg_fade_color");
    		bg.css("opacity",0.5);
    		bg.css("display","block");
    		$(".storediv").show();
            var top =( $(window).height() - $(".storediv").height() ) / 2;
            var left = ( $(window).width() - $(".storediv").width() ) / 2;
            $(".storediv").css('top', top+'px');
            $(".storediv").css('left', left+'px');
    	}
    	
    	function store_hide(){
    		var bg	=	$("#bg_fade_color");
    		$(".storediv").hide();
    		bg.css("opacity",0);
    		bg.css("display","none");
    	}
    }
};

function toogleColorVariation(){
    if(isMobile == false){
        var $ = jQuery;
        var screen = "<div id='bg_fade_color'></div>";
    	$(document.body).append(screen);
    			
    	$(".btn_color_variation").click(function() {
    		var bg	=	$("#bg_fade_color");
    		bg.css("opacity",0.5);
    		bg.css("display","block");
            var left = ( $(window).width() - $(".colordiv").width() ) / 2;
    		$(".colordiv").show();    		
    		$(".colordiv").css('top', Math.max($(document).scrollTop(), Math.min($(this).offset().top, $(document).scrollTop() + $(window).height() - $(".colordiv").outerHeight())) + 20 + 'px');
            $(".colordiv").css('left',left);    		
    	});
    	
    	$(".btn_color_close").click(function() {
    		color_hide();
    	});
    	
    	function color_hide(){
    		var bg	=	$("#bg_fade_color");
    		$(".colordiv").hide();
    		bg.css("opacity",0);
    		bg.css("display","none");
    	}
    }
};
/**
 * Change the alternative product image when hover
 */
function alternativeProductImage() {
    var $=jQuery;
	var tm;
	function swap() {
		clearTimeout(tm);
		setTimeout(function() {
			el = $(this).find('img[data-alt-src]');
			var newImg = $(el).data('alt-src');
			var oldImg = $(el).attr('src');
			$(el).attr('src', newImg).data('alt-src', oldImg);
		}.bind(this), 200);
	}	
	$('.item .product-image img[data-alt-src]').parents('.item').bind('mouseenter', swap).bind('mouseleave', swap);
};

/**
*   After Layer Update
**/
window.afterLayerUpdate = function () {
    var $=jQuery;
    if($('body').viewPC()){
		toolbar();
	}    
    alternativeProductImage();
};