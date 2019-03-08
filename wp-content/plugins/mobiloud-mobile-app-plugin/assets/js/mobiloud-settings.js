jQuery(document).ready(function() {
	jQuery("input[name='ml_show_email_contact_link']").on('click', function() {
		if (jQuery(this).is(':checked')) {
			jQuery('.ml-email-contact-row').show();
		} else {
			jQuery('.ml-email-contact-row').hide();
		}
	});
	jQuery("input[name='ml_comments_system']").on('click', function() {
		var sys = jQuery("input[name='ml_comments_system']:checked").val();
		if ( 'disqus' == sys) {
			jQuery(".ml-disqus-row").show();
		} else {
			jQuery(".ml-disqus-row").hide();
		}
	});
	jQuery("input[name='homepagetype']").on('change', function() {
		var type = jQuery("input[name='homepagetype']:checked").val();
		if ('ml_home_article_list_enabled' == type) {
			jQuery(".ml-list-enabled").show();
			jQuery(".ml-list-disabled").hide();
		} else {
			jQuery(".ml-list-enabled").hide();
			jQuery(".ml-list-disabled").show();
		}
	}).trigger('change');
	jQuery("#ml_show_rating_prompt").on('change', function() {
		if (jQuery(this).is(':checked')) {
			jQuery(".ml-rating-items").show();
		} else {
			jQuery(".ml-rating-items").hide();
		}
	}).trigger('change');
	jQuery("#ml_article_list_show_excerpt").on('change', function() {
		if (jQuery(this).is(':checked')) {
			jQuery(".show_excerpt_1").show();
		} else {
			jQuery(".show_excerpt_1").hide();
		}
	});
	jQuery("#ml_cache_enabled").on('change', function() {
		if (jQuery(this).is(':checked')) {
			jQuery(".ml-cache-items").show();
		} else {
			jQuery(".ml-cache-items").hide();
		}
	});
	jQuery("#ml_cache_flush_button").on('click', function() {
		if (!jQuery(this).is(':disabled')) {
			jQuery(this).attr('disabled', 'disabled');
			jQuery('#ml_flush_cache_spinner').show();
			var data = {
				action: 'ml_cache_flush',
				t: Math.random()
			};
			jQuery.post(ajaxurl, data, function(response) {
				jQuery("#ml_cache_flush_button").removeAttr('disabled');
				jQuery('#ml_flush_cache_spinner').hide();
				if ('OK' == response) {
					sweetAlert('Done', '', 'success');
				} else {
					sweetAlert('Error', '', 'error');
				}
			});
		}

		return false;
	});
});