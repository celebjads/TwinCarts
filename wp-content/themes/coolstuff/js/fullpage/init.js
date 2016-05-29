jQuery(document).ready(function($) {
   	$('#main-content .entry-content-page').fullpage({
	    'verticalCentered': true,
	    'css3': true,
	    'sectionsColor': ['#F0F2F4', '#fff', '#fff', '#fff'],
	    'navigation': true,
	    'navigationPosition': 'left',
	    'sectionSelector': '#main-content .entry-content-page > .wpb-container.vc_row'
   	});
   	
	$('#pbr-footer').remove();
});