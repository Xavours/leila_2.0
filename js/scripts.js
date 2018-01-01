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
				
			// Trigger Dynamic Menu
			var dynamicHeight;
			if ( document.querySelector('.project-menu') !== null){
			    console.log('yes');
        		if ( document.querySelector('.cover') !== null ){
        		    dynamicHeight = window.innerHeight + 200;
                    dynamicHeader(dynamicHeight)
                } else {
                    dynamicHeight = 200;
                    dynamicHeader(dynamicHeight)
                }
			}

			$(window).on('resize',function(){
				if($(window).width() > 769){
					$('.content > .project_wrap, .content > .featured_wrap').each(function(){
						if(!$(this).hasClass('loaded'))
							preloader($(this));
					})
				}
			});
    		
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

// Closure
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

function dynamicHeader(height) {
    $(window).scroll(function(e) {
        console.log( $(this).scrollTop() + ' / ' + height);
        if( $(this).scrollTop() > height ){
            $('header').addClass('shown');
        }
        else{
            $('header').removeClass('shown');
        }
    });
}