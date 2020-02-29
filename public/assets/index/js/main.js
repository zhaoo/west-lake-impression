
/*----------------------------
  Guru - Portfolio Template 
  Author : BootEx
  Copyright 2017
----------------------------*/
(function ($) {
    "use strict";

    //======= PRELOADER ========//
    $(window).on('load',function () {
        $('#status').fadeOut(); 
        $('#preloader').delay(550).fadeOut('slow');
        $('body').delay(550).css({
            'overflow': 'visible'
        });
    });

    //======= SITE NAVBAR ========//
    // var navMenu = $('.nav-menu')
    // 	navMenu.onePageNav();
    // $(window).on('scroll resize',function(e) {
    // 	var introH = $('.intro-section').height() - 90;
    // 	if ($(this).scrollTop() > introH) {
    // 		$('nav').fadeIn(400);
    // 		navMenu.onePageNav();
    // 	}else{
    // 		$('nav').fadeOut(200);
    // 	}
    // 	e.preventDefault();
    // });

    //======= RESPONSIVE MENU ========//
    $('.mobile-bar').on('click', function(e) {
    	$(this).toggleClass('active');
    	$('.nav-menu').toggleClass('active');
    	e.preventDefault();
    });


	//======= SMOOTH SCROLL ========//
    // $('.nav-menu li a,.down').on('click', function(e){
	// 	var anchor = $(this);
	// 	if( anchor == 'undefined' || anchor == null || anchor.attr('href') == '#' ) 
	// 		{ return; }
	// 	if ( anchor.attr('href').indexOf('#') === 0 )
	// 	{
	// 		if( $(anchor.attr('href')).length )
	// 		{
	// 			$('html, body').stop().animate( { scrollTop: $(anchor.attr('href')).offset().top - 70 }, 750);					
	// 		}
	// 		e.preventDefault();
	// 	}
	// });


    //======= PROGRESS BAR  ========//
	$('.progress-bar-style').each(function() {
		var progress = $(this).data("progress");
		var prog_width = progress+'%';
		if (progress <= 100) {
			$(this).append('<div class="bar-inner" style="width:'+prog_width+'"><span>'+prog_width+'</span></div>');
		}else{
			$(this).append('<div class="bar-inner" style="width:100%"><span>'+prog_width+'</span></div>');
		}
	});


	//======= ISOTOP FILTERING JS  ========//
    $(window).on('load', function() { 
	    var grid_container = $('.portfolio_container'),
	    	grid_item = $('.grid-item');
	    	

	     grid_container.imagesLoaded(function () {
	        grid_container.isotope({
	            itemSelector: '.grid-item',
	       		layoutMode: 'masonry'
	        });
	    });

	    $('.portfolio-filter li').on('click', function (e) {
			$('.portfolio-filter li.active').removeClass('active');
		    $(this).addClass('active');
		    var selector = $(this).attr('data-filter');
		    grid_container.isotope({
		        filter: selector
		    });
		    return false;
		    e.preventDefault();
		});
	});


	//======= MAGNIDIC POPUP JS  ========//
	$('.work-zoom').magnificPopup({
		type:'inline'
    });
    $('.link').magnificPopup({
        type:'image',
        gallery:{enabled:true},
        zoom:{enabled: true, duration: 300}
    });


	//======= Testinonial CAROUSEL  ========//
    //  $(".testinonial-carousel").owlCarousel({
    //     loop: true,
    //     nav: false,
    //     dots: false,
    //     autoplay: true,
    //     margin:5,
    //     autoplayTimeout: 3000,
    //     slideSpeed: 1000,
    //     responsive:{
	// 		0:{items:2,},
	// 		480:{items:3,},
	// 		750:{items:4,},
	// 		950:{items:5,},
	// 		1170:{items:6,},
	// 	}
    // });  
})(jQuery); //end