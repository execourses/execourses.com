jQuery(document).ready(function() {

	try {

		// if (! jQuery('#wpcf7-Aweber-cf-active').is(':checked'))

		// 	jQuery('.Aweber-custom-fields').hide();

		// jQuery('#wpcf7-Aweber-cf-active').click(function() {

		// 	if (jQuery('.Aweber-custom-fields').is(':hidden')
		// 	&& jQuery('#wpcf7-Aweber-cf-active').is(':checked')) {

		// 		jQuery('.Aweber-custom-fields').slideDown('fast');
		// 	}

		// 	else if (jQuery('.Aweber-custom-fields').is(':visible')
		// 	&& jQuery('#wpcf7-Aweber-cf-active').not(':checked')) {

		// 		jQuery('.Aweber-custom-fields').slideUp('fast');
		// 	}

		// });



	jQuery(".awb-trigger").click(function() {
		jQuery(".awb-support").slideToggle("fast");
		return false; //Prevent the browser jump to the link anchor
	});

    jQuery(".awb-trigger2").click(function() {
      jQuery(".awb-support2").slideToggle("fast");
      return false; //Prevent the browser jump to the link anchor
    });

    jQuery(".awb-trigger3").click(function() {
      jQuery(".awb-support3").slideToggle("fast");
      return false; //Prevent the browser jump to the link anchor
    });


	}

	catch (e) {

	}

});