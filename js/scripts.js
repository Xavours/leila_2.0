var thatUrl = window.location.href;
var currentProjectIndex;

(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
		$(document).ready(function(){
		  	
		  	//  Handle inverse scroll on right section
			//  Remove scrolled-down button as soon as there is a scroll
			$(window).on('scroll',function(){
                $(".right").css('bottom',$(window).scrollTop()*-1);
                
                $('.scroll-down').fadeOut(500);
            	setTimeout( function() {
            	    $('.scroll-down').remove();
            	},500);
            });

			//  Trigger preloader and fade in/out image
			$(".project").each(function(){
				preloader($(this));
			});
			
			$(window).scroll(function(){
				$(".project").each(function(){
					scrolledin($(this));
				});
			});

			$(window).on('resize',function(){
				if($(window).width() > 769){
					$('.content > .project_wrap, .content > .featured_wrap').each(function(){
						if(!$(this).hasClass('loaded'))
							preloader($(this));
					})
				}
			});
				
			// Trigger Dynamic Header
			// Apply only if it's a project page
			$('.cover') !== null ? navbarOffset = 200 : navbarOffset = window.innerHeight + 200;

			$(window).scroll(function(event){
			    didScroll = true;
			});

			setInterval(function() {
			    if (didScroll) {
			        hasScrolled();
			        didScroll = false;
			    }
			}, 250);
    		
    		//  Preload image on project page
    		$(".content").find('div').each(function(){
			    preloader($(this));
		    })
    		
    		// Trigger nav project
    		
    		    //  Previous project
        		$("a.previous").click( function () {
        		    if ( currentProjectIndex === 0 ) {
        		        currentProjectIndex = data.length - 1;
        		    } else if ( currentProjectIndex > 0 ) {
        		        currentProjectIndex--;
        		    }
        			var newUrl = data[currentProjectIndex].link;
        			window.location = newUrl;
        		});
        		
        		//  Next project
        		$("a.next").click( function () {
        			if ( currentProjectIndex === ( data.length - 1 ) ) {
        			    currentProjectIndex = 0;
        		    } else if ( currentProjectIndex < ( data.length - 1) ) {
        		        currentProjectIndex++;
        		    }
        			var newUrl = data[currentProjectIndex].link;
        			window.location = newUrl;
        		});
    		
    		scroll(0,0);
		})
	});
	
})(jQuery, this);

// Various Closure
function scrolledin(element){
	if(!element.hasClass('loaded')) return;
	
	if( element.visible( true ) ) {
		element.addClass("scrolledin");
	} else {
		element.removeClass("scrolledin");      
	}
}

function preloader(element){

	element.find('img').each(function(){

		var a = new Image, imageLoad = jQuery(this);
		a.onload = function(){ 
			imageLoad.find('img').animate({'opacity':0});
			element.addClass('scrolledin').addClass('loaded');
		};
		url = element.attr("data-url").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
		a.src = url;
		imageLoad.attr('src',url);
	});
}

// Hide Header on scroll down but show it on scroll up
// Based on the code from: https://medium.com/@mariusc23/hide-header-on-scroll-down-show-on-scroll-up-67bbaae9a78c
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarOffset = 200;

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if ( (st > lastScrollTop && st > navbarOffset) || (st <= navbarOffset) ){
        // Scroll Down
        $('header.dynamic').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height() && st > navbarOffset) {
            $('header.dynamic').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}