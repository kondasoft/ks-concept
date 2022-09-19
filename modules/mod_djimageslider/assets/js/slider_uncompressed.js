/**
 * @version $Id$
 * @package DJ-ImageSlider
 * @subpackage DJ-ImageSlider Component
 * @copyright Copyright (C) 2017 DJ-Extensions.com, All rights reserved.
 * @license DJ-Extensions.com Proprietary Use License
 * @author url: http://dj-extensions.com
 * @author email contact@dj-extensions.com
 * @developer Szymon Woronowski - szymon.woronowski@design-joomla.eu
 *
 */

!function($){

var DJSlider = {

	init: function(djsliderWrap){
		
		djsliderWrap.data();
		var settings = djsliderWrap.data('djslider');
		var options = djsliderWrap.data('animation');
		djsliderWrap.removeAttr('data-djslider');
		djsliderWrap.removeAttr('data-animation');		
		
		var djslider = $('#djslider' + settings.id).css('opacity', 0);
		var slider = $('#slider' + settings.id).css('position', 'relative');
		var cssTransition = settings.css3=='1' ? support('transition') : false;
		var touchable = (('ontouchstart' in window) || (navigator.MaxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0)); // touch screens detection
		
		// init variables
		var slides = slider.children('li');
		var slide_size = settings.slide_size;
		var visible_slides = settings.visible_slides;
		var slider_size = slide_size * slides.length;
		var max_slides = slides.length - visible_slides;
		var current_slide = 0;
		var autoplay = options.auto == '1' ? 1 : 0;
		var looponce = options.looponce == '1' ? 1 : 0;
		var stop = 0;
		var is_fading = false;
		var sliderRatio = [];
		
		// set the slides transition effect
		if (settings.slider_type == 2) { // fade
			slides.css('position', 'absolute');
			slides.css('top', 0);
			slides.css('left', 0);
			slider.css('width', slide_size);
			slides.css('opacity',0);
			slides.css('visibility','hidden');
			$(slides[0]).css('opacity',1);
			$(slides[0]).css('visibility','visible');
			if(cssTransition) slides.css(cssTransition, 'opacity '+options.duration+'ms '+options.css3transition);
						
		} else if (settings.slider_type == 1) { // vertical
			slider.css('top', 0);
			slider.css('height', slider_size);
			if(cssTransition) slider.css(cssTransition, 'top '+options.duration+'ms '+options.css3transition);

		}
		else { // horizontal
			slider.css(settings.direction, 0);
			slider.css('width', slider_size);
			if(cssTransition) slider.css(cssTransition, settings.direction+' '+options.duration+'ms '+options.css3transition);
		}
		
		if(settings.show_arrows > 0) {
			$('#next' + settings.id).on('click', function(){
				if(settings.direction == 'right') prevSlide();
				else nextSlide();
			})
			.on('keydown', function(event){
				var key = event.which;
        		if(key == 13 || key == 32) { // space bar or enter key
        			if(settings.direction == 'right') prevSlide();
    				else nextSlide();
        			event.preventDefault();
					event.stopPropagation();
        		}
			});
			$('#prev' + settings.id).on('click', function(){
				if(settings.direction == 'right') nextSlide();
				else prevSlide();
			})
			.on('keydown', function(event){
				var key = event.which;
        		if(key == 13 || key == 32) { // space bar or enter key
        			if(settings.direction == 'right') nextSlide();
    				else prevSlide();
        			event.preventDefault();
					event.stopPropagation();
        		}
			});
		}
		if(settings.show_buttons > 0) {
			$('#play' + settings.id).on('click', function(){
				autoplay = 1;
				changeNavigation();
			}).on('keydown', function(event){
				var key = event.which;
        		if(key == 13 || key == 32) { // space bar or enter key
        			autoplay = 1;
        			changeNavigation();
    				$('#pause' + settings.id).focus();
        			event.preventDefault();
					event.stopPropagation();
        		}
			});		
			$('#pause' + settings.id).on('click', function(){
				autoplay = 0;
				changeNavigation();
			}).on('keydown', function(event){
				var key = event.which;
        		if(key == 13 || key == 32) { // space bar or enter key
        			autoplay = 0;
        			changeNavigation();
    				$('#play' + settings.id).focus();
        			event.preventDefault();
					event.stopPropagation();
        		}
			});
		}
		
		djsliderWrap.on('mouseenter', function(){ if(!touchable) stop = 1; })
					.on('mouseleave', function(){ djsliderWrap.removeClass('focused'); stop = 0; })
					.on('focus', function() { 
						djsliderWrap.addClass('focused');
						djsliderWrap.trigger('mouseenter');
					})
					.on('keydown', function(e) {				
						var key = e.which;
						if(key == 37 || key == 39) {
							if(key == 39) {
								if(settings.direction == 'right') prevSlide();
			    				else nextSlide();
							} else {
								if(settings.direction == 'right') nextSlide();
								else prevSlide();
							}
							e.preventDefault();
							e.stopPropagation();
						}
					});
		
		$('.djslider-end').on('focus', function(){ djsliderWrap.trigger('mouseleave'); });
		
		djsliderWrap.djswipe(function( direction, offset ) {
			if (offset.x < 50 || offset.y > 50) { return; }
			if (direction.x == "left") { 
				if(settings.direction == 'right') prevSlide();
				else nextSlide();
			} else if (direction.x == "right") { 
				if(settings.direction == 'right') nextSlide();
				else prevSlide(); 
			}
			
		});

		if($('#cust-navigation' + settings.id).length) {
			var buttons = $('#cust-navigation' + settings.id).find('.load-button');
			buttons.each(function(index){
				var el = $(this);
				el.on('click',function(e){
					if (!is_fading && !el.hasClass('load-button-active')) {
						loadSlide(index);
					}
				}).on('keydown', function(event){
					var key = event.which;
	        		if(key == 13 || key == 32) { // space bar or enter key
	        			if (!is_fading && !el.hasClass('load-button-active')) {
							loadSlide(index);
						}
	        			event.preventDefault();
						event.stopPropagation();
	        		}
				});
				if(index > max_slides) el.css('display', 'none');
			});
		}
		
		function getSize(element){
			
			var size = {'x': element.width(), 'y': element.height()};
			
			if((size.x == 0 || size.y == 0) && element.is(':hidden')) {
				
				var parent = element.parent(),
					child, width;				
				
				while(parent.is(':hidden')) {
					child = parent;
					parent = parent.parent();
				}
				
				width = parent.width();
				
				if(child) {
					width -= parseInt(child.css('margin-left'));
					width -= parseInt(child.css('margin-right'));
					width -= parseInt(child.css('border-left-width'));
					width -= parseInt(child.css('border-right-width'));
					width -= parseInt(child.css('padding-left'));
					width -= parseInt(child.css('padding-right'));
				}
				
				var clone = element.clone();				
				clone.css({'position': 'absolute', 'visibility': 'hidden', 'max-width': width});
			    $(document.body).append(clone);
			    
			    size = {'x': clone.width(), 'y': clone.height()};
			    
				clone.remove();
								
			} 
			
			return size;			
		}
		
		function responsive(){
			
			var wrapper = djsliderWrap.parent();
			
			var parentWidth = getSize(wrapper).x;
			//parentWidth -= wrapper.css('padding-left').toInt();
			//parentWidth -= wrapper.css('padding-right').toInt();
			
			var maxWidth = parseInt(djslider.css('max-width'));
			var size = getSize(djslider);
			var newSliderWidth = size.x;
			
			if(newSliderWidth > parentWidth) {
				newSliderWidth = parentWidth;
			} else if(newSliderWidth <= parentWidth && (!maxWidth || newSliderWidth < maxWidth)){
				newSliderWidth = (parentWidth > maxWidth ? maxWidth : parentWidth);
			}
			
			if(!sliderRatio[visible_slides]) sliderRatio[visible_slides] = size.x / size.y;
			var ratio = sliderRatio[visible_slides];
			var newSliderHeight = newSliderWidth / ratio;
			//console.log(ratio);
			djslider.css('width', newSliderWidth);
			djslider.css('height', newSliderHeight);
			
			if (settings.slider_type == 2) { // fade
				
				slider.css('width', newSliderWidth);
				slides.css('width', newSliderWidth);
				slides.css('height', newSliderHeight);
				
			} else if (settings.slider_type == 1) { // vertical
				
				var space = parseInt($(slides[0]).css('margin-bottom'));
				slide_size = (newSliderHeight + space) / visible_slides;
				slider_size = slides.length * slide_size + slides.length;
				slider.css('height', slider_size);
				
				slides.css('width', newSliderWidth);
				slides.css('height', slide_size - space);
				
				slider.css('top',-slide_size * current_slide);
				
			} else { // horizontal
				
				var space = settings.direction == 'right' ? parseInt($(slides[0]).css('margin-left')) : parseInt($(slides[0]).css('margin-right'));
				
				var visibles = Math.ceil(newSliderWidth / (settings.slide_size + space));
				
				if(visibles != visible_slides) {
					visible_slides = (visibles > settings.visible_slides ? settings.visible_slides : visibles);
					max_slides = slides.length - visible_slides;
					if($('#cust-navigation' + settings.id).length) {
						var buttons = $('#cust-navigation' + settings.id).find('.load-button');
						buttons.each(function(index){
							var el = $(this);
							if(index > max_slides) el.css('display', 'none');
							else el.css('display', '');
						});
					}
					if(!sliderRatio[visible_slides]) sliderRatio[visible_slides] = (visible_slides * slide_size - space) / size.y;
					ratio = sliderRatio[visible_slides];
					//console.log(ratio);
					newSliderHeight = newSliderWidth / ratio;
					djslider.css('height', newSliderHeight);
				}
				
				slide_size = (newSliderWidth + space) / visible_slides;
				slider_size = slides.length * slide_size + slides.length;
				slider.css('width', slider_size);
				
				slides.css('width', slide_size - space);
				slides.css('height', newSliderHeight);
				
				slider.css(settings.direction,-slide_size * current_slide);
				
				if(current_slide > max_slides) loadSlide(max_slides);
			}
			
			if(settings.show_buttons > 0 || settings.show_arrows > 0) {
				
				// get some vertical space for navigation
				button_pos = $('#navigation' + settings.id).position().top;				
				if(button_pos < 0) {					
					djsliderWrap.css('padding-top', -button_pos);
					djsliderWrap.css('padding-bottom', 0);										
				} else {
					buttons_height = 0;
					if(settings.show_arrows > 0) {
						buttons_height = getSize($('#next' + settings.id)).y;
						buttons_height = Math.max(buttons_height,getSize($('#prev' + settings.id)).y);
					}
					if(settings.show_buttons > 0) {
						buttons_height = Math.max(buttons_height,getSize($('#play' + settings.id)).y);
						buttons_height = Math.max(buttons_height,getSize($('#pause' + settings.id)).y);
					}				
					padding = button_pos + buttons_height - newSliderHeight;
					if(padding > 0) {
						
						djsliderWrap.css('padding-top', 0);
						djsliderWrap.css('padding-bottom', padding);
						
					} else {
						djsliderWrap.css('padding-top', 0);
						djsliderWrap.css('padding-bottom', 0);
					}
				}
				
				// put navigation inside the slider if it's wider than window 
				buttons_margin = parseInt($('#navigation' + settings.id).css('margin-left')) + parseInt($('#navigation' + settings.id).css('margin-right'));
				if(buttons_margin < 0 && getSize($(window)).x < getSize($('#navigation' + settings.id)).x - buttons_margin) {
					
					$('#navigation' + settings.id).css('margin-left',0);
					$('#navigation' + settings.id).css('margin-right',0);
				}				
			}
			
			updateTabindex();
		}
		
		function updateActiveButton(active){
			if($('#cust-navigation' + settings.id).length) buttons.each(function(index){
				var button = $(this);
				button.removeClass('load-button-active');
				if(index==active) button.addClass('load-button-active');
			});			
		}
		
		function nextSlide(){
			if (current_slide < max_slides) {
				loadSlide(current_slide + 1);
				if(looponce && current_slide == max_slides) {
					autoplay = 0;
					changeNavigation();
				}
			} else {
				loadSlide(0);
			}
		}
		
		function prevSlide(){
			if (current_slide > 0) loadSlide(current_slide - 1);
			else loadSlide(max_slides);
		}
			
		function loadSlide(index) {
			if(current_slide == index) return;
			
			if (settings.slider_type == 2) {
				if(is_fading) return;
				is_fading = true;
				prev_slide = current_slide;
				current_slide = index;
				makeFade(prev_slide);				
			} else {
				current_slide = index;
				if(settings.slider_type == 1) { // vertical
					if(cssTransition) {
						slider.css('top',-slide_size * current_slide);
					} else {
						slider.animate({top: -slide_size * current_slide}, options.duration, options.transition);
					}
				} else { // horizontal
					if(cssTransition) {
						slider.css(settings.direction,-slide_size * current_slide);
					} else {
						if(settings.direction == 'right') slider.animate({right: -slide_size * current_slide}, options.duration, options.transition);
						else slider.animate({left: -slide_size * current_slide}, options.duration, options.transition);
					}
				}
			}
			
			updateTabindex();
			updateActiveButton(current_slide);
		}
		
		function makeFade(prev_slide){
			$(slides[current_slide]).css('visibility','visible');
			if(cssTransition) {
				$(slides[current_slide]).css('opacity',1);
				$(slides[prev_slide]).css('opacity',0);
			} else {				
				$(slides[current_slide]).animate({opacity: 1}, options.duration, options.transition);
				$(slides[prev_slide]).animate({opacity: 0}, options.duration, options.transition);
			}
			setTimeout(function(){
				$(slides[prev_slide]).css('visibility','hidden');
				is_fading = false;
			}, options.duration);
		}
		
		function changeNavigation(){
			if (autoplay) {
				$('#play' + settings.id).css('display', 'none');
				$('#pause' + settings.id).css('display', 'block');
			}
			else {
				$('#pause' + settings.id).css('display', 'none');
				$('#play' + settings.id).css('display', 'block');
			}
		}
		
		function slidePlay(){
			setTimeout(function(){
				if (autoplay && !stop) 
					nextSlide();
				slidePlay();
			}, options.delay);
		}
		
		function sliderLoaded(){
			// hide loader and show slider
			djsliderWrap.css('background','none');
			
			djslider.css('opacity', 1);
			
			if(settings.show_buttons > 0) {
				
				play_width = getSize($('#play' + settings.id)).x;
				$('#play' + settings.id).css('margin-left',-play_width/2);
				pause_width = getSize($('#pause' + settings.id)).x;
				$('#pause' + settings.id).css('margin-left',-pause_width/2);
				
				if(autoplay) {
					$('#play' + settings.id).css('display','none');
				} else {
					$('#pause' + settings.id).css('display','none');
				}
			}
			
			// start autoplay
			slidePlay();
		}
		
		function support(p) {
			
			var b = document.body || document.documentElement,
			s = b.style;
			
			// No css support detected
			if(typeof s == 'undefined') return false;
			
			// Tests for standard prop
			if(typeof s[p] == 'string') return p;
			
			// Tests for vendor specific prop
			v = ['Moz', 'Webkit', 'Khtml', 'O', 'ms', 'Icab'],
			pu = p.charAt(0).toUpperCase() + p.substr(1);
			for(var i=0; i<v.length; i++) {
				//console.log(v[i] + pu);
				if(typeof s[v[i] + pu] == 'string') return ('-' + v[i].toLowerCase() + '-' + p);
			}
			
			return false;
		}
		
		function updateTabindex() {
			slides.each(function(index){
				var focusable = $(this).find('a[href], input, select, textarea, button');
				if(index >= current_slide && index < current_slide + parseInt(visible_slides)) { // visible
					focusable.each(function(){
						$(this).removeProp('tabindex');
					});
				} else { // not visible
					focusable.each(function(){
						$(this).prop('tabindex', '-1');
					});
				}
	        });
		}
		
		if(settings.preload) setTimeout(sliderLoaded, settings.preload);
		//else if (DocumentLoaded) sliderLoaded();
		else $(window).load(sliderLoaded);
		
		responsive();
		
		$(window).on('resize', responsive);
		$(window).on('load', responsive);
	}
	
	
};

/* swipe event handling inspired by Blake Simpsion swipe.js
 * http://blog.blakesimpson.co.uk/read/51-swipe-js-detect-touch-direction-and-distance
 */
$.fn.djswipe = $.fn.djswipe || function( callback ) {
	var touchDown = false,
		originalPosition = null,
		info = null;
		$el = $( this );

	function swipeInfo( event ) {
		var touches = event.originalEvent.changedTouches || e.originalEvent.touches;
		var x = touches[0].pageX,
		y = touches[0].pageY,
		dx, dy;

		dx = ( x > originalPosition.x ) ? "right" : "left";
		dy = ( y > originalPosition.y ) ? "down" : "up";

		return {
			direction: {
				x: dx,
				y: dy
			},
			offset: {
				x: Math.abs(x - originalPosition.x),
				y: Math.abs(originalPosition.y - y)
			}
		};
	}

	$el.on( "touchstart", function ( event ) {
		touchDown = true;
		var touches = event.originalEvent.changedTouches || e.originalEvent.touches;
		originalPosition = {
			x: touches[0].pageX,
			y: touches[0].pageY
		};
	});

	$el.on( "touchend", function () {
		touchDown = false;
		if(info) callback( info.direction, info.offset );
		originalPosition = null;
		info = null;
	});

	$el.on( "touchmove", function ( event ) {
		if ( !touchDown ) { return;}
		info = swipeInfo( event );
	});

	return true;
};

$(document).ready(function(){
	
	$('[data-djslider]').each(function(){
		DJSlider.init($(this));
	});
	
});

}(jQuery);