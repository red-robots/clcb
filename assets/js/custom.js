/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	/*
	*
	*	Current Page Active
	*
	------------------------------------*/

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	/*
	*
	*	Isotope with Images Loaded
	*
	------------------------------------*/

	/*
	*
	*	Smooth Scroll to Anchor
	*
	------------------------------------*/
	/*
	*
	*	Nice Page Scroll
	*
	------------------------------------*/
	$("html").niceScroll();
	
    
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
    
    $("span.red-button a").each(function(){
        $(this).wrapInner("<span></span>");
    });
    
    if( $("#story-carousel").length > 0 ) {
        const mySiema = new Siema({
          selector: '#story-carousel',
          duration: 200,
          easing: 'ease-out',
          perPage: 1,
          startIndex: 0,
          draggable: true,
          multipleDrag: true,
          threshold: 20,
          loop: false
        });
        document.querySelector('.s_prev').addEventListener('click', () => mySiema.prev());
        document.querySelector('.s_next').addEventListener('click', () => mySiema.next());
    }
});// END #####################################    END