jQuery(document).ready(function() {        
        jQuery(".navi a.menu_a").hover(function(){
            var img_url = jQuery(this).attr('data-image-type');
            jQuery('div.categroy-img img').attr('src', img_url);
	});
	/*
	jQuery(".navi a.menu_a").mouseover(function(){
            var img_url = jQuery(this).attr('data-image-type');
            jQuery('div.categroy-img img').attr('src', img_url);
	}); */
        jQuery('.navi a.menu_a').mouseleave(function () {
            jQuery('div.categroy-img img').attr('src', '');
        });
});