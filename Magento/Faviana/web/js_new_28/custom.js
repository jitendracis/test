var $j = jQuery.noConflict(); 
 
// DDROP DOWN FOOTER SECTION
$j(document).ready(function() {
    $j(".footer-links h4").click(function(event) {
	//console.log("Div pe click h");
	if ($j(this).next(".unstyled").hasClass("open-nav")) {
	    $j(this).next(".unstyled").removeClass("open-nav");
	} else {
	    $j("ul").removeClass("open-nav");
	    $j(this).next(".unstyled").addClass("open-nav");
	}
    });

    $j("body").click(
	function(e) {
	    if (e.target.className !== "click-div") {
		// console.log("outside");
		$j(".open-div").removeClass("open-nav");
	    } 
	}
    );
});

// fixed header on scroll
$j(window).scroll(function() {
    if ($j(this).scrollTop() > 180){  
	$j('.navi').addClass("sticky");
    }
    else{
	$j('.navi').removeClass("sticky");
    }
    
    if ($j(this).scrollTop() > 100){  
	$j('header .container').addClass("fixed");
    }
    else{
	$j('header .container').removeClass("fixed");
    }
});

// TOP HEADER SECTION
$j( document).ready(function(){
	$j(".filter").click(function(){
	    $j(".category-holder").slideToggle();
	});
		
	$j(".nav-ico").click(function(){
	    $j(".navi").slideToggle();
	});
		
	$j(".navi ul > li").click(function(){
	    $j(this).toggleClass("active");
	    $j(this).children(".subnav").slideToggle();	
	});
	
	$j(".news-letter .news-field .form-control").click(function(){
	    $j(".news-additional").slideToggle();
	});
		
	/*$j(".header-widgets ul li:last-child").hover(function(){
		$j(".basic-search").toggleClass("show-holder");
	});
	*/
	
	$j('.inputOverlay').click(function(e) {
		$j(".header-widgets ul li.search").removeClass('openInput');
	});
	
	$j('#search').focus(function(e) {
		$j(".header-widgets ul li.search").addClass('openInput');
	});
});