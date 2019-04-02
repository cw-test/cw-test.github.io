<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/** @type string $pageList */ ?>
<div class="wrap settings supapress-wrap" data-site-url="<?php echo SUPAPRESS_SITE_URL; ?>/">
	<?php include_once SUPAPRESS_PLUGIN_DIR . '/admin/views/header.php'; ?>
    <?php do_action( 'supapress_admin_notices' ); ?>
	<form method="post" action="options.php" autocomplete="off" id="supapress-settings-form">
		<h2 class="nav-tab-wrapper">
			<a href="javascript:void(0);" data-tab="general" class="nav-tab nav-tab-active">General</a>
			<a href="javascript:void(0);" data-tab="links" class="nav-tab">Links</a>
			<a href="javascript:void(0);" data-tab="cache" class="nav-tab">Cache</a>
			<a href="javascript:void(0);" data-tab="seo" class="nav-tab">SEO</a>
			<a href="javascript:void(0);" data-tab="advanced" class="nav-tab">Advanced</a>
		</h2>
		<?php settings_fields( 'supapress-settings' ); ?>
		<?php do_settings_sections( 'supapress-settings' ); ?>
		<div class="general nav-tab-content">
			<div class="supapress-field-wrapper">
				<label class="supapress-label" for="api_key">API Key:</label>
				<input class="supapress-input" name="api_key" id="api_key" type="text" placeholder="Enter your API key here" value="<?php echo esc_attr( get_option('api_key') ); ?>" />
			</div>
	        <div class="supapress-field-wrapper">
	            <label class="supapress-label" for="no_books">No books text (Optional):</label>
	            <input class="supapress-input" name="no_books" id="no_books" type="text" placeholder="<?php echo SUPAPRESS_DEFAULT_NO_BOOKS_MESSAGE; ?>" value="<?php echo esc_attr( get_option('no_books') ); ?>" />
	        </div>
			<div class="supapress-field-wrapper">
				<label class="supapress-label" for="no_book">Book not found text (Optional):</label>
				<input class="supapress-input" name="no_book" id="no_book" type="text" placeholder="<?php echo SUPAPRESS_DEFAULT_BOOK_NOT_FOUND_MESSAGE; ?>" value="<?php echo esc_attr( get_option('no_book') ); ?>" />
			</div>
			<div class="supapress-field-wrapper">
				<label class="supapress-label" for="service_url">Service URL (Optional):</label>
				<input class="supapress-input" name="service_url" id="service_url" type="text" placeholder="Only change if you know what you're doing" value="<?php echo esc_attr( get_option('service_url') ); ?>" />
			</div>
		</div>
		<div class="links hide nav-tab-content">
			<div class="supapress-field-wrapper">
				<p class="green-heading supapress-tooltip-wrapper">
					<span>Build book page urls</span>
					<span class="supapress-tooltip-icon" title="Use the dropdowns below to show / hide your book page url settings.<br />---<br />Select the WordPress page containing your product details module from the dropdown then enter your URL pattern.">
						<svg class="svg-icon">
							<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-tooltip"></use>
						</svg>
					</span>
				</p>
			</div>
			<div class="urls book-urls">
				<?php supapress_get_book_urls($pageList); ?>
			</div>
		</div>
		<div class="cache hide nav-tab-content">
            <div class="supapress-field-wrapper">
                <p class="supapress-paragraph">
					<span>
                        Each unique service call is currently being cached by default for <?php echo( SUPAPRESS_CACHE_LIFETIME_DEFAULT / HOUR_IN_SECONDS ); ?>
                        hours.
                        <br/>
                        Click the 'clear cache' button below to instantly clear this cache.
                    </span>
                </p>
            </div>
            <div class="supapress-field-wrapper">
                <p class="supapress-paragraph">
                    <span id="supapress-clear-cache-button">Clear Cache</span>
                </p>
            </div>
			<?php
			$cache_settings = array(
				'product_details_cache_lifetime' => SUPAPRESS_CACHE_LIFETIME_PRODUCT_DETAILS,
				'search_results_cache_lifetime'  => SUPAPRESS_CACHE_LIFETIME_SEARCH_RESULTS,
				'isbn_lookups_cache_lifetime'    => SUPAPRESS_CACHE_LIFETIME_ISBN_LOOKUP
			);
			?>
            <div class="supapress-field-wrapper">
                <p class="supapress-paragraph">
                    <span>You can override the duration of the cache for each type of service call below:</span>
                </p>
            </div>
            <div class="supapress-field-wrapper supapress-cache-lifetime">
                <label for="supapress-product-details-cache-lifetime" class="supapress-label">Product Details Cache
                    Lifetime:</label>
                <select id="supapress-product-details-cache-lifetime" name="product_details_cache_lifetime"
                        class="supapress-dropdown">
                    <option <?php echo supapress_selected( $cache_settings, 'product_details_cache_lifetime', '86400' ); ?>
                            value="86400">24 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'product_details_cache_lifetime', '57600' ); ?>
                            value="57600">16 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'product_details_cache_lifetime', '43200' ); ?>
                            value="43200">12 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'product_details_cache_lifetime', '28800' ); ?>
                            value="28800">8 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'product_details_cache_lifetime', '21600' ); ?>
                            value="21600">6 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'product_details_cache_lifetime', '14400' ); ?>
                            value="14400">4 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'product_details_cache_lifetime', '7200' ); ?>
                            value="7200">2 hours
                    </option>
                </select>
            </div>
            <div class="supapress-field-wrapper supapress-cache-lifetime">
                <label for="supapress-search-results-cache-lifetime" class="supapress-label">Search Results Cache
                    Lifetime:</label>
                <select id="supapress-product-details-cache-lifetime" name="search_results_cache_lifetime"
                        class="supapress-dropdown">
                    <option <?php echo supapress_selected( $cache_settings, 'search_results_cache_lifetime', '86400' ); ?>
                            value="86400">24 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'search_results_cache_lifetime', '57600' ); ?>
                            value="57600">16 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'search_results_cache_lifetime', '43200' ); ?>
                            value="43200">12 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'search_results_cache_lifetime', '28800' ); ?>
                            value="28800">8 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'search_results_cache_lifetime', '21600' ); ?>
                            value="21600">6 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'search_results_cache_lifetime', '14400' ); ?>
                            value="14400">4 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'search_results_cache_lifetime', '7200' ); ?>
                            value="7200">2 hours
                    </option>
                </select>
            </div>
            <div class="supapress-field-wrapper supapress-cache-lifetime">
                <label for="supapress-isbn-lookups-cache-lifetime" class="supapress-label">ISBN Lookups Cache
                    Lifetime:</label>
                <select id="supapress-product-details-cache-lifetime" name="isbn_lookups_cache_lifetime"
                        class="supapress-dropdown">
                    <option <?php echo supapress_selected( $cache_settings, 'isbn_lookups_cache_lifetime', '86400' ); ?>
                            value="86400">24 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'isbn_lookups_cache_lifetime', '57600' ); ?>
                            value="57600">16 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'isbn_lookups_cache_lifetime', '43200' ); ?>
                            value="43200">12 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'isbn_lookups_cache_lifetime', '28800' ); ?>
                            value="28800">8 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'isbn_lookups_cache_lifetime', '21600' ); ?>
                            value="21600">6 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'isbn_lookups_cache_lifetime', '14400' ); ?>
                            value="14400">4 hours
                    </option>
                    <option <?php echo supapress_selected( $cache_settings, 'isbn_lookups_cache_lifetime', '7200' ); ?>
                            value="7200">2 hours
                    </option>
                </select>
            </div>
        </div>
		<div class="seo hide nav-tab-content">
			<p class="green-heading supapress-tooltip-wrapper">
				<span>Please enter the relevant SEO settings</span>
					<span class="supapress-tooltip-icon" title="You will need to use the Yoast plugin in order to override the SEO values output by WordPress">
						<svg class="svg-icon">
							<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-tooltip"></use>
						</svg>
					</span>
			</p>
			<div class="supapress-accordion-wrapper">
				<div class="element supapress-accordion-header open">	<span class="element-config-icon">		<span class="svg-right-arrow open">			<svg class="svg-icon">				<use xlink:href="http://supapress-paul.dev.wai.co.uk/wp-content/plugins/supapress/admin/img/svg/sprite.svg#icon-right-arrow"/>			</svg>		</span>		<span>		    Product Details		</span>	</span></div>	<div class="supapress-accordion-content" style="display: block;">
					<div class="supapress-accordion-content-inner">
						<div class="supapress-field-wrapper">
							<label class="supapress-label" for="supapress-product-details-seo-override">Override SEO:</label>
							<div class="onoffswitch">
								<input type="hidden" name="product_details_seo_override" value="off" />
								<input type="checkbox" name="product_details_seo_override" class="onoffswitch-checkbox" id="supapress-product-details-seo-override"<?php echo get_option('product_details_seo_override') === 'on' ? "checked='checked'" : ''; ?> />
								<label class="onoffswitch-label" for="supapress-product-details-seo-override">
									<span class="onoffswitch-inner" data-label-before="Yes" data-label-after="No"></span>
									<span class="onoffswitch-switch"></span>
								</label>
							</div>
						</div>
						<div class="supapress-field-wrapper">
							<label for="supapress-product-details-seo-title" class="supapress-label">Title:</label>
							<input class="widget_link_pattern supapress-input widget_input_60" data-default="%title%" id="supapress-product-details-seo-title" name="product_details_seo_title" type="text" placeholder="%title%" value="<?php echo esc_attr( get_option('product_details_seo_title') ); ?>" />
						</div>

						<div class="supapress-field-wrapper">
							<label for="supapress-product-details-seo-description" class="supapress-label">Meta description:</label>
							<input class="widget_link_pattern supapress-input widget_input_60" data-default="%description%" id="supapress-product-details-seo-description" name="product_details_seo_description" type="text" placeholder="%description%" value="<?php echo esc_attr( get_option('product_details_seo_description') ); ?>" />
						</div>

						<div class="supapress-field-wrapper">
							<label for="supapress-product-details-seo-canonical" class="supapress-label">Canonical:</label>

							<div class="supapress-links-wrapper">
								<div class="supapress-domain-slug code"><span><?php echo get_site_url(); ?></span></div>
								<div class="supapress-link-pattern-wrapper">
									<input class="widget_link_pattern supapress-input" data-default="/%isbn13%" data-trim-trailing-slash="true" id="supapress-product-details-seo-canonical" name="product_details_seo_canonical" type="text" placeholder="/%isbn13%" value="<?php echo esc_attr( get_option('product_details_seo_canonical') ); ?>" />
								</div>
							</div>
						</div>

                        <div class="supapress-field-wrapper">
                            <p class="supapress-paragraph">Please note: in order to get the Facebook and Twitter images to show a book's cover your must set a default Facebook image in Yoast <a href="<?php echo admin_url( 'admin.php?page=wpseo_social#top#facebook' ); ?>">here</a></p>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="advanced hide nav-tab-content">
			<div class="supapress-field-wrapper">
				<p class="supapress-paragraph">
					<span>If you would like to enable AngularJS support for your site, turn on the option below.</span>
					<br />
					<span>You will need to make sure that you add <b>supapressAngular</b> as a dependency of you AngularJS app as the code below shows:</span>
				</p>
				<code class="supapress-javascript-code">
					<span class="keyword">var</span>
					myApp
					<span class="operator">=</span>
					angular<span class="punctuation">.</span><span class="function">module</span><span class="punctuation">(</span><span class="string">'myApp'</span><span class="punctuation">,</span>
					<span class="punctuation">[</span><span class="string">'supapressAngular'</span><span class="punctuation">]</span><span class="punctuation">)</span><span class="punctuation">;</span>
				</code>
			</div>
			<div class="supapress-field-wrapper">
				<label class="supapress-label" for="angularjs_support">Enable AngularJS support:</label>
				<div class="onoffswitch">
					<input type="hidden" value="off" name="angularjs_support">
					<input type="checkbox" id="angularjs_support" class="onoffswitch-checkbox" name="angularjs_support"<?php echo esc_attr( get_option( 'angularjs_support' ) ) == 'on' ? ' checked="checked"' : ''; ?>>
					<label for="angularjs_support" class="onoffswitch-label">
						<span class="onoffswitch-inner" data-label-before="Yes" data-label-after="No"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="save-button-wrapper">
			<?php submit_button('Save Changes', 'save-button', 'submit', false); ?>
		</div>
	</form>
</div>
