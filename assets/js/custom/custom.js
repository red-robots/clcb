/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	
	// $('.otherteam').hover(function() {
	// 	$(this).find('.dropdown').addClass('open');
	// });

	$('.otherteam').hover(
		function(){$(this).find('.dropdown').addClass('open')},
		function(){$(this).find('.dropdown').removeClass('open')}
	);
	$('.otherteam').hover(
		function(){$(this).find('.rotate').addClass('closed')},
		function(){$(this).find('.rotate').removeClass('closed')}
	);
	

   $('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    var diz = $(this); 
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {

      	/* from main navigation */
      	if( diz.parents('.menu-item').length>0 ) {
      		$('ul.sub-menu li.menu-item').removeClass('current_page_item');
      		diz.parents('.menu-item').addClass('current_page_item');
      	}
      	
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
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
	var $container = $('#container').imagesLoaded( function() {
  	$container.isotope({
    // options
	 itemSelector: '.item',
		  masonry: {
			gutter: 15
			}
 		 });
	});

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
	new WOW().init();
    
    $("span.red-button a").each(function(){
      $(this).wrapInner("<span></span>");  
    });
    
    if( $(".simple-carousel").length > 0 ) {
        var mySiema = new Siema({
            selector: '.simple-carousel',
            duration: 200,
            easing: 'ease-out',
            perPage: 1,
            startIndex: 0,
            draggable: true,
            multipleDrag: true,
            threshold: 20,
            loop: false
        });
       
        $('body').on("click",".s_navi",function(e){
            e.preventDefault();
            var a = $(this).data("action");
            if(a=='next') {
                mySiema.next();
            } else {
                mySiema.prev();
            }
        });
    }
    
    $('#viewMemberList').on("click",function(){
        $('#otherMembers').slideToggle('fast').toggleClass('open');
    });
    
    $('#leadershipTabs li').on('click',function(e){
        e.preventDefault();
        var tab = $(this).find('a').attr('href');
        $('#leadershipTabs li').removeClass('active');
        $(this).addClass('active');
        $('.tabcontent .text').removeClass('active');
        $(tab).addClass('active');
        $(this).next().toggleClass('active');
    });
    
    $('#searchTabs .top').on('click',function(){
        var parent = $(this).parents('li.tab');
        $('#searchTabs li').removeClass('active');
        parent.toggleClass('active');
    });
    
    $("#submitButton").on("click",function(e){
        e.preventDefault();
        $('.gform_wrapper form').trigger("submit");
    });

    /* Completed Assignment Pagination */
    $(document).on("click",".assignment_pagination a",function(e){
    	e.preventDefault();
    	var page_url = $(this).attr('href');
    	window.history.replaceState( null, null, page_url );
    	$('.divspinner').fadeIn();
    	setTimeout(function(){
    		$('.reloaddiv').load(page_url + " #js_reload",function(){
    			$('.divspinner').fadeOut();
    		});
    	},400);
    });

    $("#searchTabs li .content").each(function(){
      var br = $(this).find("br");
      br.last().remove();
    });
    
});// END #####################################    END