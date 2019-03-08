<div class="ml2-block">
	<div class="ml2-header"><h2>Menu Structure</h2></div>
	<div class="ml2-body">

		<p>Drag each item into the order you prefer. Any questions or need some help with the app's menu configuration?
			<a class="contact" href="mailto:support@mobiloud.com">Send us a message</a>.</p>
		<div class='ml-col-row'>
			<div class="ml-col-row">
				<h4>Categories</h4>
				<div class="ml-form-row">
					<?php Mobiloud_Admin::load_ajax_insert( 'menu_cat' ); ?>
					<a href="#" class="button-secondary ml-add-category-btn" style="display: none">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-categories-holder">
				</ul>
				<h4>Custom Taxonomies</h4>
				<div class="ml-form-row">
					<select name="ml-tax-group" class="ml-select-add">
						<option value="">Select Taxonomy</option>
						<?php $taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' ); ?>
						<?php
						foreach ( $taxonomies as $tax ) {
							echo "<option value='$tax->query_var'>$tax->label</option>";
						}
						?>
					</select>
				</div>
				<div class="ml-form-row ml-tax-group-row" style="display:none;">
					<select name="ml-terms" class="ml-select-add">
						<option value="">Select Term</option>
					</select>
					<a href="#" class="button-secondary ml-add-term-btn">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-terms-holder">
					<?php
					$menu_terms = Mobiloud::get_option( 'ml_menu_terms', array() );
					foreach ( $menu_terms as $menu_term_data ) {
						$menu_term_data_ex = explode( "=", $menu_term_data );
						$menu_term_object  = get_term_by( 'id', $menu_term_data_ex[1], $menu_term_data_ex[0] );

						?>
						<li rel="<?php echo $menu_term_object->term_id; ?>">
							<span
								class="dashicons-before dashicons-menu"></span><?php echo( isset( $menu_term_object->name ) ? $menu_term_object->name : '' ); ?>
							<input type="hidden" name="ml-menu-terms[]" value="<?php echo $menu_term_data; ?>"/>
							<a href="#" class="dashicons-before dashicons-trash ml-item-remove"></a>
						</li>
						<?php

					}
					?>
				</ul>

				<h4>Tags</h4>
				<div class="ml-form-row">
					<?php Mobiloud_Admin::load_ajax_insert( 'menu_tags' ); ?>
					<a href="#" class="button-secondary ml-add-tag-btn" style="display: none">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-tags-holder">
				</ul>

				<h4>Pages</h4>
				<div class="ml-form-row">
					<?php Mobiloud_Admin::load_ajax_insert( 'menu_page' ); ?>
					<a href="#" class="button-secondary ml-add-page-btn" style="display: none">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-pages-holder">
					<?php
					?>
				</ul>

				<h4>Links</h4>
				<div class="ml-form-row">
					<input type="text" placeholder="Menu Title" id="ml_menu_url_title" name="ml_menu_url_title"/>
					<input type="text" placeholder="http://www.domain.com/" size="32" id="ml_menu_url" name="ml_menu_url"/>
					<a href="#" class="button-secondary ml-add-link-btn">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-links-holder">
					<?php
					$menu_urls = get_option( "ml_menu_urls", array() );
					foreach ( $menu_urls as $menu_url ) {
						?>
						<li rel="<?php echo $menu_url['url']; ?>">
							<span
								class="dashicons-before dashicons-menu"></span><?php echo esc_html( $menu_url['urlTitle'] ); ?>
							- <span
								class="ml-sub-title"><?php echo Mobiloud::trim_string( esc_html( $menu_url['url'] ), 50 ); ?></span>
							<input type="hidden" name="ml-menu-links[]"
								value="<?php echo esc_attr( $menu_url['urlTitle'] ) . ':=:' . esc_attr( $menu_url['url'] ); ?>"/>
							<a href="#" class="dashicons-before dashicons-trash ml-item-remove"></a>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>

	</div>
</div>
<div class="ml2-block">
	<div class="ml2-header"><h2>Menu Settings</h2></div>
	<div class="ml2-body">

		<div class='ml-col-row'>
			<div class="ml-col-half">
				<p>Customise your app menu by adjusting what it should display.</p>
			</div>
			<div class="ml-col-half">
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_menu_show_favorites" name="ml_menu_show_favorites"
						value="true" <?php echo Mobiloud::get_option( 'ml_menu_show_favorites' ) ? 'checked' : ''; ?>/>
					<label for="ml_menu_show_favorites">Show Favourites in the app menu</label>
				</div>
			</div>
		</div>
	</div>
</div>