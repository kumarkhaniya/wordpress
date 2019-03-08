<div class="ml2-block">
	<div class="ml2-header"><h2><?php echo Mobiloud_Admin::$settings_tabs[$active_tab][ 'title' ]; ?></h2></div>
	<div class="ml2-body">

		<p>The options on this page let you define exactly what content is presented in the app's home screen,
			article lists and single article screens.</p>

		<p>Any questions or need some help? Contact us at <a class="contact" href="mailto:support@mobiloud.com">support@mobiloud.com</a></p>

	</div>
</div>

<div class="ml2-block">
	<div class="ml2-header"><h2>Application details</h2></div>
	<div class="ml2-body">

		<h4>Email Contact</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Setup email contact details.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_show_email_contact_link" name="ml_show_email_contact_link"
						value="true" <?php echo Mobiloud::get_option( 'ml_show_email_contact_link' ) ? 'checked' : ''; ?>/>
					<label for="ml_show_email_contact_link">Show email contact link?</label>
				</div>
				<div class="ml-email-contact-row ml-form-row" <?php
				echo ! Mobiloud::get_option( 'ml_show_email_contact_link' ) ? 'style="display:none;"' : ''; ?>>
					<label for="ml_contact_link_email">Enter public email address</label>
					<input id="ml_contact_link_email" type="text" size="36" name="ml_contact_link_email"
						value="<?php echo esc_attr( Mobiloud::get_option( "ml_contact_link_email", '' ) ); ?>"/>
				</div>
			</div>
		</div>

		<h4>Copyright Notice</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Enter the copyright notice which will be displayed in your app's settings screen.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row">
					<textarea id="ml_copyright_string" name="ml_copyright_string" rows="4"
						style="width:100%"><?php echo esc_attr( Mobiloud::get_option( "ml_copyright_string", '' ) ); ?></textarea>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ml2-block">
	<div class="ml2-header"><h2>Home Screen Settings</h2></div>
	<div class="ml2-body">

		<div class="ml-col-row">
			<h4>Choose what to show on your app's home screen.</h4>
			<div class="ml-radio-wrap">
				<input type="radio" id="ml_home_article_list_enabled" name="homepagetype"
					value="ml_home_article_list_enabled" <?php echo get_option( 'ml_home_article_list_enabled', true ) ? 'checked' : ''; ?>/>
				<label for="ml_home_article_list_enabled">Article List (Recommended)</label>
			</div>
			<div class="ml-radio-wrap">
				<input type="radio" id="ml_home_page_enabled" name="homepagetype"
					value="ml_home_page_enabled" <?php echo get_option( 'ml_home_page_enabled' ) ? 'checked' : ''; ?>/>
				<label for="ml_home_page_enabled">Page contents</label>
				<select name="ml_home_page_id" style="max-width: 460px;">
					<option value="">Select a page</option>
					<?php $pages = get_pages(); ?>
					<?php
					foreach ( $pages as $p ) {
						$selected = '';
						if ( Mobiloud::get_option( "ml_home_page_id" ) == $p->ID ) {
							$selected = 'selected="selected"';
						}
					?>
						<option value="<?php echo $p->ID; ?>" <?php echo $selected; ?>>
							<?php echo $p->post_title; ?>
						</option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="ml-radio-wrap">
				<input type="radio" id="ml_home_url_enabled" name="homepagetype"
					value="ml_home_url_enabled" <?php echo get_option( 'ml_home_url_enabled' ) ? 'checked' : ''; ?>/>
				<label for="ml_home_url_enabled">URL (e.g. homepage)</label>
				<input id="ml_home_url" placeholder="http://" name="ml_home_url" type="url"
					value="<?php echo get_option( 'ml_home_url_enabled' ) ? get_option( 'ml_home_url' ) : ''; ?>">
			</div>
		</div>

		<div class="ml-form-row ml-home-screen-label ml-list-disabled">
			<label>Articles Menu Item</label>
			<p>Enter the label you'd like to use for the 'Articles' menu item, letting users list your articles.</p>
			<div class="ml-form-row ml-checkbox-wrap">
				<input type="checkbox" id="ml_show_article_list_menu_item" name="ml_show_article_list_menu_item"
					value="true" <?php echo Mobiloud::get_option( 'ml_show_article_list_menu_item' ) ? 'checked' : ''; ?>/>
				<label for="ml_show_article_list_menu_item">Show 'Article' list menu item</label>
			</div>
			<input type='text' id='ml_article_list_menu_item_title' name='ml_article_list_menu_item_title'
				value='<?php echo Mobiloud::get_option( 'ml_article_list_menu_item_title', 'Articles' ); ?>'/>
		</div>


		<h4 class="ml-list-enabled">Custom Post Types</h4>
		<div class='ml-col-row ml-list-enabled'>
			<div class='ml-col-half'>
				<p>Select which post types should be included in the article list.</p>
				<?php
				$posttypes         = get_post_types( '', 'names' );
				$includedPostTypes = explode( ",", Mobiloud::get_option( "ml_article_list_include_post_types", "post" ) );
				foreach ( $posttypes as $v ) {
					if ( $v != "attachment" && $v != "revision" && $v != "nav_menu_item" ) {
						$checked = '';
						if ( in_array( $v, $includedPostTypes ) ) {
							$checked = "checked";
						}
				?>
						<div class="ml-form-row ml-checkbox-wrap no-margin">
							<input type="checkbox" id='postypes_<?php echo esc_attr( $v ); ?>' name="postypes[]"
								value="<?php echo esc_attr( $v ); ?>" <?php echo $checked; ?>/>
							<label for="postypes_<?php echo esc_attr( $v ); ?>"><?php echo esc_html( $v ); ?></label>
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>

		<h4 class="ml-list-enabled">Categories</h4>
		<div class='ml-col-row ml-list-enabled'>
			<p>Select which categories should be included in the article list.</p>
			<div><?php Mobiloud_Admin::load_ajax_insert( 'settings_cat' ); ?></div>
		</div>

		<h4 class="ml-list-enabled">Custom Taxonomies</h4>
		<div class='ml-col-row ml-list-enabled'>
			<div class='ml-col-half'>
				<p>Select which taxonomies should be included in the article list.</p>
				<?php Mobiloud_Admin::load_ajax_insert( 'settings_tax' ); ?>
			</div>
		</div>

		<h4 class="ml-list-enabled">Restrict search results</h4>
		<div class='ml-col-row ml-list-enabled'>
			<div class='ml-col-half'>
				<p>Prevent results from unchecked categories from being displayed in search results.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_restrict_search_results" name="ml_restrict_search_results"
						value="true" <?php echo Mobiloud::get_option( 'ml_restrict_search_results' ) ? 'checked' : ''; ?>/>
					<label for="ml_restrict_search_results">If checked, search results should only display post types,
						categories and taxonomies that were selected in the settings.</label>
				</div>

			</div>
		</div>

		<h4 class="ml-list-enabled">Sticky categories</h4>
		<div class='ml-col-row ml-list-enabled'>
			<div class='ml-col-half'>
				<p>The first posts from each sticky category are displayed before all others in the app's article
					list.</p>
			</div>
			<div class='ml-col-half'>
				<div class='ml-form-row ml-left-align clearfix'>
					<label class='ml-width-120'>First category</label>
					<?php Mobiloud_Admin::load_ajax_insert( 'settings_sticky_cat_1' ); ?>
					<label>No. of Posts</label>
					<input type='text' size='2' id='ml_sticky_category_1_posts' name='ml_sticky_category_1_posts'
						value='<?php echo esc_attr( Mobiloud::get_option( 'ml_sticky_category_1_posts', 3 ) ); ?>'/>
				</div>
				<div class='ml-form-row ml-left-align clearfix'>
					<label class='ml-width-120'>Second category</label>
					<?php Mobiloud_Admin::load_ajax_insert( 'settings_sticky_cat_2' ); ?>
					<label>No. of Posts</label>
					<input type='text' size='2' id='ml_sticky_category_2_posts' name='ml_sticky_category_2_posts'
						value='<?php echo esc_attr( Mobiloud::get_option( 'ml_sticky_category_2_posts', 3 ) ); ?>'/>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ml2-block">
	<div class="ml2-header"><h2>Article List settings</h2></div>
	<div class="ml2-body">

		<h4>Date display options</h4>
		<div class="ml-col-row">
			<div class="ml-radio-wrap">
				<input type="radio" id="ml_date_type_pretty" name="ml_datetype"
					value="prettydate" <?php echo get_option( 'ml_datetype', 'prettydate' ) == 'prettydate' ? 'checked' : ''; ?>/>
				<label for="ml_date_type_pretty">Show pretty dates (e.g. "2 hours ago")</label>
			</div>
			<div class="ml-radio-wrap">
				<input type="radio" id="ml_date_type_date" name="ml_datetype"
					value="datetime" <?php echo get_option( 'ml_datetype', 'prettydate' ) == 'datetime' ? 'checked' : ''; ?>/>
				<label for="ml_date_type_date">Show full dates</label>
				<input name="ml_dateformat" id="ml_dateformat" type="text"
					value="<?php echo get_option( "ml_dateformat", 'F j, Y' ); ?>"/>
			</div>
		</div>

		<h4>List preferences</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Adjust how your content will show in article lists, affecting your app's main list as well as
					category lists.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_article_list_enable_dates" name="ml_article_list_enable_dates"
						value="true" <?php echo Mobiloud::get_option( 'ml_article_list_enable_dates' ) ? 'checked' : ''; ?>/>
					<label for="ml_article_list_enable_dates">Show post dates in the list</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_article_list_show_excerpt" name="ml_article_list_show_excerpt"
						value="true" <?php echo Mobiloud::get_option( 'ml_article_list_show_excerpt' ) ? 'checked' : ''; ?>/>
					<label for="ml_article_list_show_excerpt">Show excerpts in article list</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_article_list_show_comment_count"
						name="ml_article_list_show_comment_count"
						value="true" <?php echo Mobiloud::get_option( 'ml_article_list_show_comment_count' ) ? 'checked' : ''; ?>/>
					<label for="ml_article_list_show_comment_count">Show comments count in article list</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_original_size_image_list" name="ml_original_size_image_list"
						value="true" <?php echo Mobiloud::get_option( 'ml_original_size_image_list', true ) ? 'checked' : ''; ?>/>
					<label for="ml_original_size_image_list">Resize article cards in the list to follow the original
						image proportions</label>
				</div>

			</div>
		</div>
		<?php
		$is_excerpt_style = (Mobiloud::get_option( 'ml_article_list_view_type', 'extended' ) == 'extended')
		&& (Mobiloud::get_option( 'ml_article_list_show_excerpt' )) ? '' : ' style="display:none;"';
		?>
		<h4 class="show_excerpt_1"<?php echo $is_excerpt_style; ?>>Excerpts length</h4>
		<div class='ml-col-row show_excerpt_1'<?php echo $is_excerpt_style; ?>>
			<div class='ml-col-half'>
				<p>You can define a maximum length for excerpts in number of characters.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row">
					<input type="number" id="ml_excerpt_length" name="ml_excerpt_length" min="1" max="10000"
						value="<?php echo esc_attr( Mobiloud::get_option( "ml_excerpt_length", 100) ); ?>"/>
				</div>
			</div>
		</div>

		<h4>Number of articles</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Number of articles returned in each request.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row">
					<input type="number" id="ml_articles_per_request" name="ml_articles_per_request" min="1" max="100"
						value="<?php echo esc_attr( Mobiloud::get_option( "ml_articles_per_request", 15) ); ?>"/>
				</div>
			</div>
		</div>

		<h4>Custom field in article list</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Your app's article list can show data from a Custom Field (e.g. author, price, source) defined in
					your posts.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_custom_field_enable" name="ml_custom_field_enable"
						value="true" <?php echo Mobiloud::get_option( 'ml_custom_field_enable' ) ? 'checked' : ''; ?>/>
					<label for="ml_custom_field_enable">Show custom field in article list</label>
				</div>
				<div class="ml-form-row ml-left-align clearfix">
					<label class='ml-width-120' for="ml_custom_field_name">Field Name</label>
					<input type="text" placeholder="Custom Field Name" id="ml_custom_field_name"
						name="ml_custom_field_name"
						value="<?php echo esc_attr( Mobiloud::get_option( 'ml_custom_field_name' ) ); ?>"/>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ml2-block">
	<div class="ml2-header"><h2>Post and Page screen settings</h2></div>
	<div class="ml2-body">

		<h4>Featured image in the article screen</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>You can switch display or hide the featured image in the article screen. You can also add featured
					images manually using the Editor functionality, <a target="_blank"
						href="https://www.mobiloud.com/help/knowledge-base/featured-images/?utm_source=wp-plugin-admin&utm_medium=web&utm_campaign=content_page">read
						our guide</a>.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_show_article_featuredimage" name="ml_show_article_featuredimage"
						value="true" <?php echo Mobiloud::get_option( 'ml_show_article_featuredimage' ) ? 'checked' : ''; ?>/>
					<label for="ml_show_article_featuredimage">Show featured image</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_original_size_featured_image" name="ml_original_size_featured_image"
						value="true" <?php echo Mobiloud::get_option( 'ml_original_size_featured_image' ) ? 'checked' : ''; ?>/>
					<label for="ml_original_size_featured_image">Show featured images respecting the original image
						proportions</label>
				</div>
			</div>
		</div>

		<h4>Image galleries</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Your app will ignore links attached to images to ensure that these open in the built-in image
					gallery. If instead you'd prefer image links to work inside the app, you can change this setting
					accordingly.</p>
				<p>As an exception, say to allow an image banner within the content to load an external link while
					ensuring other images are always opened in the gallery, you can assign the class
					<i>ml_followlinks</i> to the image banner.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_followimagelinks" name="ml_followimagelinks"
						value="1" <?php echo Mobiloud::get_option( 'ml_followimagelinks' ) ? 'checked' : ''; ?>/>
					<label for="ml_followimagelinks">Load links instead of image gallery for images with links</label>
				</div>
			</div>
		</div>

		<h4>Post and page meta information</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Change which meta elements of your posts and pages should be displayed in the post and page screens.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_post_author_enabled" name="ml_post_author_enabled"
						value="true" <?php echo Mobiloud::get_option( 'ml_post_author_enabled' ) ? 'checked' : ''; ?>/>
					<label for="ml_post_author_enabled">Show author in posts</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_page_author_enabled" name="ml_page_author_enabled"
						value="true" <?php echo Mobiloud::get_option( 'ml_page_author_enabled' ) ? 'checked' : ''; ?>/>
					<label for="ml_page_author_enabled">Show author in pages</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_post_date_enabled" name="ml_post_date_enabled"
						value="true" <?php echo Mobiloud::get_option( 'ml_post_date_enabled' ) ? 'checked' : ''; ?>/>
					<label for="ml_post_date_enabled">Show date in posts</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_page_date_enabled" name="ml_page_date_enabled"
						value="true" <?php echo Mobiloud::get_option( 'ml_page_date_enabled' ) ? 'checked' : ''; ?>/>
					<label for="ml_page_date_enabled">Show date in pages</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_post_title_enabled" name="ml_post_title_enabled"
						value="true" <?php echo Mobiloud::get_option( 'ml_post_title_enabled' ) ? 'checked' : ''; ?>/>
					<label for="ml_post_title_enabled">Show title in posts</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_page_title_enabled" name="ml_page_title_enabled"
						value="true" <?php echo Mobiloud::get_option( 'ml_page_title_enabled' ) ? 'checked' : ''; ?>/>
					<label for="ml_page_title_enabled">Show title in pages</label>
				</div>
			</div>
		</div>

		<h4>Internal links</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Your app can open internal links (e.g. to posts, pages or categories) and open them in the native article or category views. You can disable this and links will open in the internal browser normally used for external links.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_internal_links" name="ml_internal_links"
						value="true" <?php echo Mobiloud::get_option( 'ml_internal_links' ) ? 'checked' : ''; ?>/>
					<label for="ml_internal_links">Open internal links in native views</label>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ml2-block">
	<div class="ml2-header"><h2>Related Posts</h2></div>
	<div class="ml2-body">

		<div class='ml-col-row'>
			<p>In order to use the Related Posts feature you will need to install the Jetpack Plugin and make sure the "Related Posts" feature is enabled.</p>
			<div class="ml-form-row ml-checkbox-wrap">
				<input type="checkbox" id="ml_related_posts" name="ml_related_posts"
					value="true" <?php echo Mobiloud::get_option( 'ml_related_posts' ) ? 'checked' : ''; ?>/>
				<label for="ml_related_posts">Enable Related Posts</label>
			</div>
		</div>

		<h4 class='ml-related-items'>Header</h4>
		<div class='ml-col-row ml-related-items'>
			<div class='ml-col-half'>
				<p>Enter the header you'd like to use.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row">
					<input id="ml_related_header" type="text" size="36" name="ml_related_header"
						value="<?php echo esc_attr( Mobiloud::get_option( "ml_related_header", '' ) ); ?>"/>
				</div>
			</div>
		</div>

		<h4 class='ml-related-items'>Items</h4>
		<div class='ml-col-row ml-related-items'>
			<div class='ml-col-half'>
				<p>Check items you'd like to show.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_related_image" name="ml_related_image"
						value="true" <?php echo Mobiloud::get_option( 'ml_related_image' ) ? 'checked' : ''; ?>/>
					<label for="ml_related_image">Show Image</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_related_excerpt" name="ml_related_excerpt"
						value="true" <?php echo Mobiloud::get_option( 'ml_related_excerpt' ) ? 'checked' : ''; ?>/>
					<label for="ml_related_excerpt">Show Excerpt</label>
				</div>
				<div class="ml-form-row ml-checkbox-wrap no-margin">
					<input type="checkbox" id="ml_related_date" name="ml_related_date"
						value="true" <?php echo Mobiloud::get_option( 'ml_related_date' ) ? 'checked' : ''; ?>/>
					<label for="ml_related_date">Show Date</label>
				</div>

			</div>
		</div>

	</div>
</div>

<div class="ml2-block">
	<div class="ml2-header"><h2>Commenting settings</h2></div>
	<div class="ml2-body">

		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Select the commenting system you'd like to use in your app.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row">
					<div class="ml-radio-wrap">
						<input type="radio" id="ml_comments_system_wordpress" name="ml_comments_system"
							value="wordpress" <?php echo get_option( 'ml_comments_system', 'wordpress' ) == 'wordpress' ? 'checked' : ''; ?>/>
						<label for="ml_comments_system_wordpress">Wordpress</label>
					</div>
					<div class="ml-radio-wrap">
						<input type="radio" id="ml_comments_system_disqus" name="ml_comments_system"
							value="disqus" <?php echo get_option( 'ml_comments_system', 'wordpress' ) == 'disqus' ? 'checked' : ''; ?>/>
						<label for="ml_comments_system_disqus">Disqus</label>
					</div>
					<div class="ml-radio-wrap">
						<input type="radio" id="ml_comments_system_facebook" name="ml_comments_system"
							value="facebook" <?php echo get_option( 'ml_comments_system', 'wordpress' ) == 'facebook' ? 'checked' : ''; ?>/>
						<label for="ml_comments_system_facebook">Facebook Comments</label>
					</div>
					<div class="ml-radio-wrap">
						<input type="radio" id="ml_comments_system_disabled" name="ml_comments_system"
							value="disabled" <?php echo get_option( 'ml_comments_system', 'wordpress' ) == 'disabled' ? 'checked' : ''; ?>/>
						<label for="ml_comments_system_disabled">Comments should be disabled</label>
					</div>
				</div>
				<div
					class="ml-disqus-row ml-form-row" <?php echo Mobiloud::get_option( 'ml_comments_system', 'wordpress' ) == 'disqus' ? '' : 'style="display: none;"'; ?>>
					<label>Disqus shortname <span class="required">*</span></label>
					<input name="ml_disqus_shortname" id="ml_disqus_shortname" type="text"
						value="<?php echo get_option( "ml_disqus_shortname", '' ); ?>"/>
					<p>A shortname is the unique identifier assigned to a Disqus site. All the comments posted to a site
						are referenced with the shortname.
						See <a href="#">how to find your shortname</a>.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ml2-block">
	<div class="ml2-header"><h2>Login settings</h2></div>
	<div class="ml2-body">

		<div class='ml-col-row'>
			<p>MobiLoud can integrate with a number of WordPress membership plugins and require your users to
				authenticate to access the contents of your app.</p>
			<p>Don't see your membership plugin here? <a class="contact" href="mailto:support@mobiloud.com">Contact us</a> for more
				information.</p>
			<div class="ml-form-row ml-checkbox-wrap">
				<input type="checkbox" id="ml_subscriptions_enable" name="ml_subscriptions_enable"
					value="true" <?php echo Mobiloud::get_option( 'ml_subscriptions_enable' ) ? 'checked' : ''; ?>/>
				<label for="ml_subscriptions_enable">Enable <a target="_blank"
					href="https://wordpress.org/plugins/groups/">WP-Groups</a> integration</label>
			</div>
		</div>
	</div>
</div>
<div class="ml2-block">
	<div class="ml2-header"><h2>Rating Prompt Settings</h2></div>
	<div class="ml2-body">

		<div class='ml-col-row'>
			<p>If enabled, a prompt will be displayed after the selected interval so the user can rate your app.</p>
			<div class="ml-form-row ml-checkbox-wrap">
				<input type="checkbox" id="ml_show_rating_prompt" name="ml_show_rating_prompt"
					value="true" <?php echo Mobiloud::get_option( 'ml_show_rating_prompt' ) ? 'checked' : ''; ?>/>
				<label for="ml_show_rating_prompt">Enable rating prompt</label>
			</div>
		</div>

		<h4 class='ml-rating-items'>Display after specific number of days</h4>
		<div class='ml-col-row ml-rating-items'>
			<div class='ml-col-half'>
				<p>Select the number of days that must pass after the app installation for the rating prompt to be displayed</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row">
					<input type="number" id="ml_days_interval_rating_prompt" name="ml_days_interval_rating_prompt" min="1" max="365"
						value="<?php echo esc_attr( Mobiloud::get_option( "ml_days_interval_rating_prompt", 1) ); ?>"/>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ml2-block">
	<div class="ml2-header"><h2>Welcome screen settings</h2></div>
	<div class="ml2-body">

		<h4>Welcome screen URL</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>The welcome screen will be displayed when the user first opens the app, you can <a href="https://www.mobiloud.com/help/knowledge-base/how-to-use-the-welcome-screen-feature">click here</a> for more details on how to create and configure your welcome screen.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row">
					<input id="ml_welcome_screen_url" placeholder="http://" name="ml_welcome_screen_url" type="url"
						value="<?php echo esc_attr(get_option( 'ml_welcome_screen_url' )); ?>">
				</div>
			</div>
		</div>

		<h4>Welcome screen required version</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>In case changes were made to your welcome screen you can adjust its version to make sure it gets displayed to users the next time they open the app.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row">
					<input type="text" id="ml_welcome_screen_required_version" name="ml_welcome_screen_required_version" required="required" maxlength="20"
						value="<?php echo esc_attr( Mobiloud::get_option( 'ml_welcome_screen_required_version', '1.0' ) ); ?>"/>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ml2-block">
	<div class="ml2-header"><h2>Advanced settings</h2></div>
	<div class="ml2-body">

		<h4>Cache expiration</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Your server and any caching plugin installed can improve loading times by caching responses from the plugin.
					This setting allows you to define the duration of the cache (in minutes), after which a new version is created.
					This affects the "Cache-Control" header in the MobiLoud content API.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row">
					<input type="number" id="ml_cache_expiration" name="ml_cache_expiration" min="1" max="1440"
						value="<?php echo esc_attr( Mobiloud::get_option( "ml_cache_expiration", 30) ); ?>"/>
				</div>
			</div>
		</div>

		<h4>Internal plugin caching</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Allow the MobiLoud plugin to cache its response, storing it in the WordPress database.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_cache_enabled" name="ml_cache_enabled"
						value="true" <?php echo Mobiloud::get_option( 'ml_cache_enabled' ) ? 'checked' : ''; ?>/>
					<label for="ml_cache_enabled">Enable caching engine</label>
				</div>
				<div class="ml-form-row ml-cache-items"<?php if (!Mobiloud::get_option( 'ml_cache_enabled' )) {echo ' style="display: none;"';}; ?>>
					<a href="#" id="ml_cache_flush_button" class="button button-primary">Flush internal cache</a>
					<img class="ml-spinner" id="ml_flush_cache_spinner" src="<?php echo MOBILOUD_PLUGIN_URL. 'assets/img/spinner.gif'; ?>">
				</div>
			</div>
		</div>

		<h4>Children Page Navigation</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Did you built a site with a complex page hierarchy and you'd like to have this available in the app?
					The page hierarchy navigation feature allows users to see a list of children pages at the bottom of
					every page within your app.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_hierarchical_pages_enabled" name="ml_hierarchical_pages_enabled"
						value="true" <?php echo Mobiloud::get_option( 'ml_hierarchical_pages_enabled' ) ? 'checked' : ''; ?>/>
					<label for="ml_hierarchical_pages_enabled">Enable page hierarchy navigation</label>
				</div>
			</div>
		</div>

		<!-- <h4>Image preloading</h4>
		<div class='ml-col-row'>
		<div class='ml-col-half'>
		<p>When this option is enabled, the app will preload images for all posts on start.</p>
		</div>
		<div class='ml-col-half'>
		<div class="ml-form-row ml-checkbox-wrap">
		<input type="checkbox" id="ml_image_cache_preload" name="ml_image_cache_preload"
		value="true" <?php echo Mobiloud::get_option( 'ml_image_cache_preload' ) ? 'checked' : ''; ?>/>
		<label for="ml_image_cache_preload">Enable preloading of images</label>
		</div>
		</div>
		</div> -->

		<h4>Remove unused shortcodes</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>To remove any shortcodes that remain visibile in the app, you can enable this feature.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_remove_unused_shortcodes" name="ml_remove_unused_shortcodes"
						value="true" <?php echo Mobiloud::get_option( 'ml_remove_unused_shortcodes', true) ? 'checked' : ''; ?>/>
					<label for="ml_remove_unused_shortcodes">Remove unused shortcodes</label>
				</div>
			</div>
		</div>

		<h4>Really Simple SSL plugin</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Please turn on this option if you are using this plugin to avoid it breaking the plugin's content feed.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_fix_rsssl" name="ml_fix_rsssl"
						value="true" <?php echo Mobiloud::get_option( 'ml_fix_rsssl') ? 'checked' : ''; ?>/>
					<label for="ml_fix_rsssl">Support Really Simple SSL plugin</label>
				</div>
			</div>
		</div>

		<h4>PHP notices</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>Disable notices and warnings in the API response.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_disable_notices" name="ml_disable_notices"
						value="true" <?php echo Mobiloud::get_option( 'ml_disable_notices', true) ? 'checked' : ''; ?>/>
					<label for="ml_disable_notices">Disable PHP notices</label>
				</div>
			</div>
		</div>

		<h4>Alternative Featured Image</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>You can override the featured image used in article lists and at the top of every article with a
					secondary image you can define for every post.</p>
				<p>Install the <a href="https://wordpress.org/plugins/multiple-post-thumbnails/">Multiple Post
						Thumbnails</a> plugin and enter the ID of the secondary featured image field you've setup,
					normally "secondary-image".</p>
				<p>Alternatively enter the name of a custom field where you'll enter, for each post, the full URL of the
					alternative image.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-left-align clearfix">
					<label class='ml-width-120' for="ml_custom_featured_image">Image ID</label>
					<input type="text" placeholder="Image ID" id="ml_custom_featured_image"
						name="ml_custom_featured_image"
						value="<?php echo esc_attr( Mobiloud::get_option( 'ml_custom_featured_image' ) ); ?>"/>
				</div>
			</div>
		</div>

		<h4>Override Article/Page URL with a custom field</h4>
		<div class='ml-col-row'>
			<div class='ml-col-half'>
				<p>When sharing your content, users will normally share the article's URL. For a curation-based
					app, though, you might want users to share the source for that story.</p>
				<p>Enter a custom field name to the right which you can fill for every post with the URL you want users
					to share.</p>
			</div>
			<div class='ml-col-half'>
				<div class="ml-form-row ml-left-align clearfix">
					<label class='ml-width-120' for="ml_custom_field_url">URL Field Name</label>
					<input type="text" placeholder="Custom Field Name" id="ml_custom_field_url"
						name="ml_custom_field_url"
						value="<?php echo esc_attr( Mobiloud::get_option( 'ml_custom_field_url' ) ); ?>"/>
				</div>
			</div>
		</div>

	</div>
</div>
