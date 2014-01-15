$(function () {
	
	// Preload images
	$.preloadCssImages();
	
	
	// Style file input
	$("input[type=file]").filestyle({ 
	    image: "images/upload.gif",
	    imageheight : 30,
	    imagewidth : 80,
	    width : 250
	});
	
	
	// Web stats
	$('table.stats').hide().visualize({
		type: 'line',	// 'bar', 'area', 'pie', 'line'
		width: '880px',
		height: '240px',
		colors: ['#6fb9e8', '#ec8526', '#9dc453', '#ddd74c']
	});
	
	
	// Check / uncheck all checkboxes
	$('.check_all').click(function() {
		$(this).parents('form').find('input:checkbox').attr('checked', $(this).is(':checked'));   
	});
	
	
	// Set WYSIWYG editor
	$('.wysiwyg').wysiwyg({css: "css/wysiwyg.css"});
	
	
	// Modal boxes - to all links with rel="facebox"
	$('a[rel*=facebox]').facebox()
	
	
	// Messages
	$('.block .message').hide().append('<span class="close" title="Dismiss"></span>').fadeIn('slow');
	$('.block .message .close').hover(
		function() { $(this).addClass('hover'); },
		function() { $(this).removeClass('hover'); }
	);
		
	$('.block .message .close').click(function() {
		$(this).parent().fadeOut('slow', function() { $(this).remove(); });
	});
	
	
	// Tabs
	$(".tab_content").hide();
	$("ul.tabs li:first-child").addClass("active").show();
	$(".block").find(".tab_content:first").show();

	$("ul.tabs li").click(function() {
		$(this).parent().find('li').removeClass("active");
		$(this).addClass("active");
		$(this).parents('.block').find(".tab_content").hide();

		var activeTab = $(this).find("a").attr("href");
		$(activeTab).show();
		return false;
	});
		
		
	// CSS tweaks
	$('#header #nav li:last').css('background', 'none');
	$('.block_head ul').each(function() { $('li:first', this).css('background', 'none'); });
	$('.block table tr:odd').css('background-color', '#fbfbfb');
	$('.block form input[type=file]').addClass('file');
	
	
	// IE6 PNG fix
	$(document).pngFix();
		
});