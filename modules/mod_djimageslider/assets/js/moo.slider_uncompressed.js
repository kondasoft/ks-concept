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

    	var settings = JSON.decode(djsliderWrap.getProperty('data-djslider'));
    	var options = JSON.decode(djsliderWrap.getProperty('data-animation'));
    	
    	var djslider = $('djslider' + settings.id).setStyle('opacity', 0);
    	var slider = $('slider' + settings.id).setStyle('position', 'relative');
    	var cssTransition = settings.css3 == '1' ? support('transition') : false;
    	
    	// init variables
    	var slides = slider.getChildren('li');
    	var slide_size = settings.slide_size;
    	var visible_slides = settings.visible_slides;
    	var slider_size = slide_size * slides.length;
    	var max_slides = slides.length - visible_slides;
        var current_slide = 0;
        var autoplay = options.auto == '1' ? 1 : 0;
        var stop = 0;
		var is_fading = false;
        
        // set the slides transition effect
        var slideImages;
		if (settings.slider_type == 2) { // fade
			slides.setStyle('position', 'absolute');
			slides.setStyle('top', 0);
			slides.setStyle('left', 0);
			slider.setStyle('width', slide_size);
			slides.setStyle('opacity',0);
			slides.setStyle('visibility','hidden');
			slides[0].setStyle('opacity',1);
			slides[0].setStyle('visibility','visible');
			if(cssTransition) slides.setStyle(cssTransition, 'opacity '+options.duration+'ms '+options.css3transition);
			else slides.set('tween',{property: 'opacity', duration: options.duration, transition: options.transition});
						
		} else if (settings.slider_type == 1) { // vertical
            slider.setStyle('top', 0);
            slider.setStyle('height', slider_size);
            if(cssTransition) slider.setStyle(cssTransition, 'top '+options.duration+'ms '+options.css3transition);
            else {
            	slideImages = new Fx.Tween(slider, {
					property: 'top', 
	                duration: options.duration,
	                transition: options.transition,
	                link: 'cancel'
	            });
            }
        }
        else { // horizontal
            slider.setStyle(settings.direction, 0);
            slider.setStyle('width', slider_size);
            if(cssTransition) slider.setStyle(cssTransition, settings.direction+' '+options.duration+'ms '+options.css3transition);
            else {
	            slideImages = new Fx.Tween(slider, {
					property: settings.direction, 
	                duration: options.duration,
	                transition: options.transition,
	                link: 'cancel'
	            });
            }
        }
        
        if(settings.show_arrows > 0) {
	        $('next' + settings.id).addEvent('click', function(){
	        	if(settings.direction == 'right') prevSlide();
				else nextSlide();
	        });        
	        $('prev' + settings.id).addEvent('click', function(){
	        	if(settings.direction == 'right') nextSlide();
				else prevSlide();
	        });
        }
        if(settings.show_buttons > 0) {
        	$('play' + settings.id).addEvent('click', function(){
	            changeNavigation();
	            autoplay = 1;
	        });        
	        $('pause' + settings.id).addEvent('click', function(){
	            changeNavigation();
	            autoplay = 0;
	        });
        }
        
		djsliderWrap.addEvents({
            'mouseenter': function(){
				stop = 1;
            },
            'mouseleave': function(){
				stop = 0;
            }
            /*,
            'swipe': function(event){
				if(event.direction == 'left') {
					if(settings.direction == 'right') prevSlide();
					else nextSlide();
				} else if(event.direction == 'right') {
					if(settings.direction == 'right') nextSlide();
					else prevSlide();
				}
			}*/
        });
        //djsliderWrap.store('swipe:cancelVertical', true);

        djsliderWrap.djswipe(function( direction, offset ) {
			if (offset.x < 100 || offset.y > 30) { return; }
			if (direction.x == "left") { 
				if(settings.direction == 'right') prevSlide();
				else nextSlide();
			} else if (direction.x == "right") { 
				if(settings.direction == 'right') nextSlide();
				else prevSlide(); 
			}
			
		});
        
		if($('cust-navigation' + settings.id)) {
			var buttons = $('cust-navigation' + settings.id).getElements('.load-button');
			buttons.each(function(el,index){
				el.addEvent('click',function(e){
					if (!is_fading && !el.hasClass('load-button-active')) {
						loadSlide(index);
					}
				});
				if(index > max_slides) el.setStyle('display', 'none');
			});
		}
		
		function getSize(element){			
			 return element.measure(function(){return this.getSize();});			
		}
		
		function responsive(){
			
			var wrapper = djsliderWrap.getParent();
			
			var parentWidth = getSize(wrapper).x;
			parentWidth -= wrapper.getStyle('padding-left').toInt();
			parentWidth -= wrapper.getStyle('padding-right').toInt();
			
			var maxWidth = djslider.getStyle('max-width').toInt();
			var size = getSize(djslider);
			var newSliderWidth = size.x;
			
			if(newSliderWidth > parentWidth) {
				newSliderWidth = parentWidth;
			} else if(newSliderWidth <= parentWidth && (!maxWidth || newSliderWidth < maxWidth)){
				newSliderWidth = (parentWidth > maxWidth ? maxWidth : parentWidth);
			}
			
        	var ratio = size.x / size.y;
			var newSliderHeight = newSliderWidth / ratio;
			
			djslider.setStyle('width', newSliderWidth);
			djslider.setStyle('height', newSliderHeight);
			
        	if (settings.slider_type == 2) { // fade
        		
				slider.setStyle('width', newSliderWidth);
				slides.setStyle('width', newSliderWidth);
				slides.setStyle('height', newSliderHeight);
				
			} else if (settings.slider_type == 1) { // vertical
				
				var space = slides[0].getStyle('margin-bottom').toInt();
				slide_size = (newSliderHeight + space) / visible_slides;
				slider_size = slides.length * slide_size + slides.length;
		        slider.setStyle('height', slider_size);
		        
		        slides.setStyle('width', newSliderWidth);
				slides.setStyle('height', slide_size - space);
				
				if(cssTransition) {
					slider.setStyle('top',-slide_size * current_slide);
				} else {
					slideImages.set(-slide_size * current_slide);
				}
				
		        
		    } else { // horizontal
		    	
		    	var space = settings.direction == 'right' ? slides[0].getStyle('margin-left').toInt() : slides[0].getStyle('margin-right').toInt();
		    	
		    	var visibles = Math.ceil(newSliderWidth / (settings.slide_size + space));
		    	
		    	if(visibles != visible_slides) {
		    		visible_slides = (visibles > settings.visible_slides ? settings.visible_slides : visibles);
		            max_slides = slides.length - visible_slides;
		            if($('cust-navigation' + settings.id)) {
		    			var buttons = $('cust-navigation' + settings.id).getElements('.load-button');
		    			buttons.each(function(el, index){
		    				if(index > max_slides) el.setStyle('display', 'none');
		    				else el.setStyle('display', 'inline-block');
		    			});
		    		}
		            ratio = (visible_slides * slide_size - space) / size.y;
					newSliderHeight = newSliderWidth / ratio;
					djslider.setStyle('height', newSliderHeight);
				}
		    	
		    	slide_size = (newSliderWidth + space) / visible_slides;
		    	slider_size = slides.length * slide_size + slides.length;
		        slider.setStyle('width', slider_size);
		        
		        slides.setStyle('width', slide_size - space);
				slides.setStyle('height', newSliderHeight);
				
				if(cssTransition) {
					slider.setStyle(settings.direction, -slide_size * current_slide);
				} else {
					slideImages.set(settings.direction, -slide_size * current_slide);
				}
				
				if(current_slide > max_slides) loadSlide(max_slides);
		    }
		    
		    if(settings.show_buttons > 0 || settings.show_arrows > 0) {
				
				// get some vertical space for navigation				
	        	button_pos = $('navigation' + settings.id).getPosition(djslider).y;	        	
				if(button_pos < 0) {					
					djsliderWrap.setStyle('padding-top', -button_pos);
					djsliderWrap.setStyle('padding-bottom', 0);										
				} else {
					buttons_height = 0;
					if(settings.show_arrows > 0) {
						buttons_height = getSize($('next' + settings.id)).y;
						buttons_height = Math.max(buttons_height,getSize($('prev' + settings.id)).y);
					}
					if(settings.show_buttons > 0) {
						buttons_height = Math.max(buttons_height,getSize($('play' + settings.id)).y);
						buttons_height = Math.max(buttons_height,getSize($('pause' + settings.id)).y);
					}				
					padding = button_pos + buttons_height - newSliderHeight;
					if(padding > 0) {
						
						djsliderWrap.setStyle('padding-top', 0);
						djsliderWrap.setStyle('padding-bottom', padding);
						
					} else {
						djsliderWrap.setStyle('padding-top', 0);
						djsliderWrap.setStyle('padding-bottom', 0);
					}
				}
	        	
	        	// put navigation inside the slider if it's wider than window 
	        	buttons_margin = $('navigation' + settings.id).getStyle('margin-left').toInt() + $('navigation' + settings.id).getStyle('margin-right').toInt();
				if(buttons_margin < 0 && window.getSize().x < getSize($('navigation' + settings.id)).x - buttons_margin) {
					
					$('navigation' + settings.id).setStyle('margin-left',0);
					$('navigation' + settings.id).setStyle('margin-right',0);
				}				
			}
		}
		
		function updateActiveButton(active){
			if($('cust-navigation' + settings.id)) buttons.each(function(button,index){
				button.removeClass('load-button-active');
				if(index==active) button.addClass('load-button-active');
			});			
		}
		
		function nextSlide(){
			if (current_slide < max_slides) loadSlide(current_slide + 1);
			else loadSlide(0);
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
				if(cssTransition) {
					if (settings.slider_type == 1) { // vertical
						slider.setStyle('top', -slide_size * current_slide);
					} else { // horizontal
						slider.setStyle(settings.direction, -slide_size * current_slide);
					}
				} else {
					slideImages.start(-slide_size * current_slide);
				}
			}
			updateActiveButton(current_slide);
		}
			
		function makeFade(prev_slide){
			slides[current_slide].setStyle('visibility','visible');
			if(cssTransition) {
				slides[current_slide].setStyle('opacity',1);
				slides[prev_slide].setStyle('opacity',0);
				setTimeout(function(){
					slides[prev_slide].setStyle('visibility','hidden');
					is_fading = false;
				}, options.duration);
			} else {				
				slides[current_slide].get('tween').start(1);
				slides[prev_slide].get('tween').start(0).chain(function(){
					slides[prev_slide].setStyle('visibility','hidden');
					is_fading = false;
				});
			}			
		}
		
        function changeNavigation(){
            if (autoplay) {
                $('pause' + settings.id).setStyle('display', 'none');
                $('play' + settings.id).setStyle('display', 'block');
            }
            else {
                $('play' + settings.id).setStyle('display', 'none');
                $('pause' + settings.id).setStyle('display', 'block');
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
			djsliderWrap.setStyle('background','none');
			
			djslider.setStyle('opacity', 1);
			
			responsive();
			
			if(settings.show_buttons > 0) {
				
				play_width = getSize($('play' + settings.id)).x;
				$('play' + settings.id).setStyle('margin-left',-play_width/2);
				pause_width = getSize($('play' + settings.id)).x;
				$('pause' + settings.id).setStyle('margin-left',-pause_width/2);
				
				if(autoplay) {
					$('play' + settings.id).setStyle('display','none');
				} else {
					$('pause' + settings.id).setStyle('display','none');
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
		
		if(settings.preload) sliderLoaded.delay(settings.preload);
		//else if (DocumentLoaded) sliderLoaded();
		else window.addEvent('load', sliderLoaded);
		
		window.addEvent('resize', responsive);
        
		djsliderWrap.removeProperties('data-djslider', 'data-animation');
    }
    
};

/* swipe event handling inspired by Blake Simpsion swipe.js
 * http://blog.blakesimpson.co.uk/read/51-swipe-js-detect-touch-direction-and-distance
 */
Element.implement({
	
	djswipe: function( callback ) {

		var touchDown = false,
			originalPosition = null,
			info = null;
			$el = this;
	
		function swipeInfo( event ) {
			var x = event.touches[0].pageX,
			y = event.touches[0].pageY,
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
	
		$el.addEvent( "touchstart", function ( event ) {
			touchDown = true;
			originalPosition = {
				x: event.touches[0].pageX,
				y: event.touches[0].pageY
			};
		});
	
		$el.addEvent( "touchend", function () {
			touchDown = false;
			if(info) callback( info.direction, info.offset );
			originalPosition = null;
			info = null;
		});
	
		$el.addEvent( "touchmove", function ( event ) {
			if ( !touchDown ) { return;}
			info = swipeInfo( event );
		});
	
		return true;
	}

});

window.addEvent('domready', function(){
	
	$$('[data-djslider]').each(function(slider){
		DJSlider.init(slider);
	});
	
});

}(document.id);