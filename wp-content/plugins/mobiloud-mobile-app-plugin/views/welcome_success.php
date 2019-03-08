<!-- step 2 -->
<?php
$return_url = get_site_url();
$timezone_check = Mobiloud::get_option( 'ml_welcome_timezone', true);
?>
<div class="ml2-block ml2-welcome-block">
	<div class="ml2-body">
		<?php if ($timezone_check) : ?>
			<h3 class="text-center title_big">Let's schedule your call!</h3>
			<br>
			<p class="text-center">Click on the button below to pick a convenient time to talk.</p>

			<script src="https://www.appointletcdn.com/loader/loader.min.js"></script>
			<input type="submit" name="submit" id="submit" class="button button-primary button-hero"
				data-appointlet-organization="mobiloud"
				data-appointlet-service="5627"
				data-appointlet-email="<?php echo esc_attr( mobiloud::get_option( 'ml_user_email' ) ); ?>"
				data-appointlet-field-name="<?php echo esc_attr( mobiloud::get_option( 'ml_user_name' ) ); ?>"
				data-appointlet-field-phone="<?php echo esc_attr( mobiloud::get_option( 'ml_user_phone' ) ); ?>"
				data-appointlet-field-site="<?php echo esc_attr( mobiloud::get_option( 'ml_user_site' ) ); ?>"
				data-appointlet-field-message="<?php echo esc_attr( mobiloud::get_option( 'ml_user_message' ) ); ?>"
				data-appointlet-field-company-name="<?php echo esc_attr( mobiloud::get_option( 'ml_user_company' ) ); ?>"
				data-appointlet-field-type="<?php echo esc_attr( mobiloud::get_option( 'ml_user_apptype' ) ); ?>"
				data-appointlet-field-utm-source="news-plugin"
				data-appointlet-query-skip_fields="1"
				data-appointlet-query-utm_source="news-plugin"
				data-appointlet-field-redirect-url="<?php echo esc_attr( $return_url ); ?>"
				data-open="<?php echo (isset($_GET[ 'open' ]) ? 1 : 0); ?>"
				value="Schedule Your Call">
			<br><br><br><br>

			<script type="text/javascript">
				jQuery(function ($) {
					var open_booking = function() {
						window.app2 = appointlet({
							organization: "mobiloud",
							email: $('#submit').data('appointlet-email'),
							fields: {
								"name": $('#submit').data('appointlet-field-name'),
								"phone": $('#submit').data('appointlet-field-phone'),
								"site": $('#submit').data('appointlet-field-site'),
								"message": $('#submit').data('appointlet-field-message'),
								"company-name": $('#submit').data('appointlet-field-company-name'),
								"type": $('#submit').data('appointlet-field-type'),
								"utm-source": $('#submit').data('appointlet-field-utm-source'),
								"redirect-url": $('#submit').data('appointlet-field-redirect-url'),
							},
							query: {
								skip_fields: true,
								utm_source: 'news-plugin',
							}
						}).show();
					}
					if ($('#submit').data('open')) {
						open_booking();
					}
					$('#submit').on('click', open_booking);
				});
			</script>
		<?php else: ?>
			<?php
			$video = 'news' == Mobiloud::get_option( 'ml_user_apptype' ) ? 'http://www.vimeo.com/296195883' : 'http://www.vimeo.com/295610034';
			?>
			<div class="ml-scheedule-time-block">
				<p>Thank you, we'll get in touch to schedule a time to talk. In the meantime, you can watch a recent webinar recording that tells you everything about MobiLoud. Got any questions? Send us an email at <a href="mailto:sales@mobiloud.com">sales@mobiloud.com</a>.</p>
			</div>
			<br>
			<br>
			<br>
			<div class="ml-welcome-video">
				<div id="embed">Loading ...</div>
			</div>
			<script>
				var videoUrl = <?php echo json_encode($video); ?>;
				var endpoint = 'https://www.vimeo.com/api/oembed.json';
				var callback = 'embedVideo';
				var url = endpoint + '?url=' + encodeURIComponent(videoUrl) + '&callback=' + callback + '&width=' + getWidth(640);
				function embedVideo(video) {
					document.getElementById('embed').innerHTML = unescape(video.html);
				}
				function getWidth(width) {
					return Math.min(width, Math.max(
						document.body.scrollWidth,
						document.documentElement.scrollWidth,
						document.body.offsetWidth,
						document.documentElement.offsetWidth,
						document.documentElement.clientWidth
						) - 53);
				}
				function vimeo_init() {
					var js = document.createElement('script');
					js.setAttribute('type', 'text/javascript');
					js.setAttribute('src', url);
					document.getElementsByTagName('head').item(0).appendChild(js);
				}
				window.onload = vimeo_init;
			</script>
			<br>
			<br>
			<input type="submit" name="submit" id="submit_price" class="button button-primary button-hero"
				value="Sign Up Now">
		<?php endif; ?>

		<p class="text-center"><a href="#" data-href="<?php echo(esc_attr($active_url)); ?>" class="welcome_question_start">Return to the plugin.</a></p>
	</div>
</div>