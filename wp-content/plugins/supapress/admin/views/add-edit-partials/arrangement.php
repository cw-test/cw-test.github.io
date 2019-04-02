<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** @type string $action */ ?>
<div class="hide arrangement nav-tab-content">
    <div class="supapress-field-wrapper search_results widget-type-specific hide">
        <p class="green-heading">Select how you want to see your results:</p>
    </div>
    <div class="supapress-field-wrapper isbn_lookup widget-type-specific hide">
        <p class="green-heading">Select how you want to see your ISBN(s):</p>
    </div>
    <div class="supapress-field-wrapper">
        <div class="widget-layout-wrapper isbn_lookup search_results widget-type-specific hide">
            <div class="widget-layout-wrapper-inner isbn_lookup search_results">
                <input name="widget_layout" id="widget_layout1" type="radio" data-sub-tab="grid"
                       value="grid"<?php echo supapress_radio_checked( $properties, 'widget_layout', 'grid', supapress_set_default( $action ) ); ?> />
                <label class="widget-layout-label grid" for="widget_layout1">
					<span class="label-content">
						<svg class="svg-icon">
							<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-grid"></use>
						</svg>
					</span>
                    <span class="widget-layout-text">Grid</span>
                </label>
            </div>
            <div class="widget-layout-wrapper-inner isbn_lookup search_results">
                <input name="widget_layout" id="widget_layout2" type="radio" data-sub-tab="list"
                       value="list"<?php echo supapress_radio_checked( $properties, 'widget_layout', 'list' ); ?> />
                <label class="widget-layout-label list" for="widget_layout2">
					<span class="label-content">
						<svg class="svg-icon">
							<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-list"></use>
						</svg>
					</span>
                    <span class="widget-layout-text">List</span>
                </label>
            </div>
            <div class="widget-layout-wrapper-inner isbn_lookup">
                <input name="widget_layout" id="widget_layout3" type="radio" data-sub-tab="carousel"
                       value="carousel"<?php echo supapress_radio_checked( $properties, 'widget_layout', 'carousel' ); ?> />
                <label class="widget-layout-label carousel" for="widget_layout3">
					<span class="label-content">
						<svg class="svg-icon">
							<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-carousel"></use>
						</svg>
					</span>
                    <span class="widget-layout-text">Carousel</span>
                </label>
            </div>
			<?php if ( ! empty( $custom_templates ) ) : ?>
                <div class="widget-layout-wrapper-inner<?php echo isset( $custom_templates['isbn_lookup'] ) ? ' isbn_lookup' : ''; ?><?php echo isset( $custom_templates['search_results'] ) ? ' search_results' : ''; ?>">
                    <input name="widget_layout" id="widget_layout4" type="radio" data-sub-tab="custom"
                           value="custom"<?php echo supapress_radio_checked( $properties, 'widget_layout', 'custom' ); ?> />
                    <label class="widget-layout-label custom" for="widget_layout4">
						<span class="label-content">
							<svg class="svg-icon">
								<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-gear"></use>
							</svg>
						</span>
                        <span class="widget-layout-text">Custom</span>
                    </label>
                </div>
			<?php endif; ?>
        </div>
    </div>
    <div class="supapress-field-wrapper grid list hide layout-content">
        <label for="per_row" class="supapress-label">How many ISBN(s) per row:</label>
        <select name="per_row" id="per_row" class="supapress-dropdown">
            <option value="1"<?php echo supapress_selected( $properties, 'per_row', 1 ); ?>>1</option>
            <option value="2"<?php echo supapress_selected( $properties, 'per_row', 2 ); ?>>2</option>
            <option value="3"<?php echo supapress_selected( $properties, 'per_row', 3 ); ?>>3</option>
            <option value="4"<?php echo supapress_selected( $properties, 'per_row', 4, supapress_set_default( $action ) ); ?>>
                4
            </option>
            <option value="5"<?php echo supapress_selected( $properties, 'per_row', 5 ); ?>>5</option>
            <option value="6"<?php echo supapress_selected( $properties, 'per_row', 6 ); ?>>6</option>
            <option value="7"<?php echo supapress_selected( $properties, 'per_row', 7 ); ?>>7</option>
            <option value="8"<?php echo supapress_selected( $properties, 'per_row', 8 ); ?>>8</option>
        </select>
    </div>
    <div class="supapress-field-wrapper list hide layout-content">
        <label for="cover_right" class="supapress-label">Display cover on the left or the right:</label>
        <div class="onoffswitch">
            <input type="hidden" name="cover_right" value="off"/>
            <input type="checkbox" name="cover_right" class="onoffswitch-checkbox"
                   id="cover_right"<?php echo supapress_checked( $properties, 'cover_right' ); ?> />
            <label class="onoffswitch-label" for="cover_right">
                <span class="onoffswitch-inner both-active" data-label-before="Right" data-label-after="Left"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
    </div>
    <div class="supapress-field-wrapper grid list carousel hide layout-content widget-type-specific isbn_lookup">
        <label for="order" class="supapress-label">How to order your ISBN(s):</label>
        <select name="order" id="order" class="supapress-dropdown">
            <option value="as-entered"<?php echo supapress_selected( $properties, 'order', 'as-entered' ); ?>>As entered
                / collection order
            </option>
            <option value="publishdate-desc"<?php echo supapress_selected( $properties, 'order', 'publishdate-desc' ); ?>>
                Newest to Oldest
            </option>
            <option value="publishdate-asc"<?php echo supapress_selected( $properties, 'order', 'publishdate-asc' ); ?>>
                Oldest to Newest
            </option>
            <option value="title-az"<?php echo supapress_selected( $properties, 'order', 'title-az' ); ?>>Title - A to
                Z
            </option>
            <option value="title-za"<?php echo supapress_selected( $properties, 'order', 'title-za' ); ?>>Title - Z to
                A
            </option>
            <option value="price-asc"<?php echo supapress_selected( $properties, 'order', 'price-asc' ); ?>>Price - Low
                to High
            </option>
            <option value="price-desc"<?php echo supapress_selected( $properties, 'order', 'price-desc' ); ?>>Price -
                High to Low
            </option>
        </select>
    </div>
    <div class="supapress-field-wrapper carousel hide layout-content">
        <label class="supapress-label" for="show_dots">Navigation dots:</label>
        <div class="onoffswitch">
            <input type="hidden" name="show_dots" value="off"/>
            <input type="checkbox" name="show_dots" class="onoffswitch-checkbox"
                   id="show_dots"<?php echo supapress_array_checked( $properties, 'carousel_settings', 'show_dots', supapress_set_default( $action ) ); ?> />
            <label class="onoffswitch-label" for="show_dots">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
    </div>
    <div class="supapress-field-wrapper carousel hide layout-content">
        <label class="supapress-label" for="show_arrows">Navigation arrow:</label>
        <div class="onoffswitch">
            <input type="hidden" name="show_arrows" value="off"/>
            <input type="checkbox" name="show_arrows" class="onoffswitch-checkbox sub-content-toggle"
                   data-sub-content="show-arrows"
                   id="show_arrows"<?php echo supapress_array_checked( $properties, 'carousel_settings', 'show_arrows' ); ?> />
            <label class="onoffswitch-label" for="show_arrows">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
    </div>
    <div class="supapress-field-wrapper hide carousel layout-content show-arrows sub-content-wrapper">
        <label class="supapress-label" for="left_arrow_image">Left Arrow:</label>
        <img class="image-preview"
             data-default-src="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/left-carousel-arrow-default.png"
             src="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/left-carousel-arrow-default.png" alt="Left Arrow"
             onerror="this.src = '<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/image-missing.jpg';"/>
        <input class="supapress-input arrow-upload" id="left_arrow_image" data-button="left_arrow_image_button"
               type="text" placeholder="Enter a URL or upload an image" name="left_arrow_image"
               value="<?php echo supapress_array_text( $properties, 'carousel_settings', 'left_arrow_image' ); ?>"/>
        <input id="left_arrow_image_button" class="upload_image_button upload-button" type="button"
               value="Upload Image"/>
    </div>
    <div class="supapress-field-wrapper hide carousel layout-content  show-arrows sub-content-wrapper">
        <label class="supapress-label" for="right_arrow_image">Right Arrow:</label>
        <img class="image-preview"
             data-default-src="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/right-carousel-arrow-default.png"
             src="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/right-carousel-arrow-default.png" alt="Right Arrow"
             onerror="this.src = '<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/image-missing.jpg';"/>
        <input class="supapress-input arrow-upload" id="right_arrow_image" data-button="right_arrow_image_button"
               type="text" placeholder="Enter a URL or upload an image" name="right_arrow_image"
               value="<?php echo supapress_array_text( $properties, 'carousel_settings', 'right_arrow_image' ); ?>"/>
        <input id="right_arrow_image_button" class="upload_image_button upload-button" type="button"
               value="Upload Image"/>
    </div>
    <div class="supapress-field-wrapper carousel hide layout-content">
        <label class="supapress-label" for="number_to_show">Number of books per row:</label>
        <select name="number_to_show" id="number_to_show" class="supapress-dropdown">
            <option value="1"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_show', 1 ); ?>>
                1
            </option>
            <option value="2"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_show', 2 ); ?>>
                2
            </option>
            <option value="3"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_show', 3 ); ?>>
                3
            </option>
            <option value="4"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_show', 4, supapress_set_default( $action ) ); ?>>
                4
            </option>
            <option value="5"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_show', 5 ); ?>>
                5
            </option>
            <option value="6"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_show', 6 ); ?>>
                6
            </option>
            <option value="7"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_show', 7 ); ?>>
                7
            </option>
            <option value="8"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_show', 8 ); ?>>
                8
            </option>
        </select>
    </div>
    <div class="supapress-field-wrapper carousel hide layout-content">
        <label class="supapress-label" for="number_to_scroll">Number of books to scroll by:</label>
        <select name="number_to_scroll" id="number_to_scroll" class="supapress-dropdown">
            <option value="1"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_scroll', 1 ); ?>>
                1
            </option>
            <option value="2"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_scroll', 2 ); ?>>
                2
            </option>
            <option value="3"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_scroll', 3 ); ?>>
                3
            </option>
            <option value="4"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_scroll', 4 ); ?>>
                4
            </option>
            <option value="5"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_scroll', 4 ); ?>>
                5
            </option>
            <option value="6"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_scroll', 6 ); ?>>
                6
            </option>
            <option value="7"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_scroll', 7 ); ?>>
                7
            </option>
            <option value="8"<?php echo supapress_array_selected( $properties, 'carousel_settings', 'number_to_scroll', 8 ); ?>>
                8
            </option>
        </select>
    </div>
    <div class="supapress-field-wrapper carousel hide layout-content">
        <label class="supapress-label" for="speed">Scroll speed (ms):</label>
        <input class="supapress-input numbers-only" id="speed" name="speed" type="text" placeholder="700"
               value="<?php echo supapress_array_text( $properties, 'carousel_settings', 'speed' ); ?>"/>
    </div>
    <div class="supapress-field-wrapper carousel hide layout-content">
        <label class="supapress-label" for="infinite_scroll">Infinite scroll:</label>
        <div class="onoffswitch">
            <input type="hidden" name="infinite_scroll" value="off"/>
            <input type="checkbox" name="infinite_scroll" class="onoffswitch-checkbox"
                   id="infinite_scroll"<?php echo supapress_array_checked( $properties, 'carousel_settings', 'infinite_scroll', supapress_set_default( $action ) ); ?> />
            <label class="onoffswitch-label" for="infinite_scroll">
                <span class="onoffswitch-inner" data-label-before="Yes" data-label-after="No"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
    </div>
    <div class="supapress-field-wrapper carousel hide layout-content">
        <label class="supapress-label" for="auto_play">Auto play:</label>
        <div class="onoffswitch">
            <input type="hidden" name="auto_play" value="off"/>
            <input type="checkbox" name="auto_play" class="onoffswitch-checkbox sub-content-toggle"
                   data-sub-content="auto-play"
                   id="auto_play"<?php echo supapress_array_checked( $properties, 'carousel_settings', 'auto_play' ); ?> />
            <label class="onoffswitch-label" for="auto_play">
                <span class="onoffswitch-inner" data-label-before="Yes" data-label-after="No"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
    </div>
    <div class="supapress-field-wrapper hide carousel layout-content auto-play sub-content-wrapper">
        <label class="supapress-label" for="auto_play_speed">Auto play scroll delay (ms):</label>
        <input class="supapress-input numbers-only" id="auto_play_speed" name="auto_play_speed" type="text"
               placeholder="3000"
               value="<?php echo supapress_array_text( $properties, 'carousel_settings', 'auto_play_speed' ); ?>"/>
    </div>
    <div class="supapress-field-wrapper carousel hide layout-content">
        <div class="supapress-tooltip-wrapper">
            <label class="supapress-label" for="lazy_load">Lazy load images:</label>
            <div class="onoffswitch">
                <input type="hidden" name="lazy_load" value="off"/>
                <input type="checkbox" name="lazy_load" class="onoffswitch-checkbox sub-content-toggle"
                       data-sub-content="lazy-load"
                       id="lazy_load"<?php echo supapress_array_checked( $properties, 'carousel_settings', 'lazy_load' ); ?> />
                <label class="onoffswitch-label" for="lazy_load">
                    <span class="onoffswitch-inner" data-label-before="Yes" data-label-after="No"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="supapress-field-wrapper hide carousel layout-content lazy-load sub-content-wrapper">
        <label class="supapress-label" for="lazy_load_placeholder">Lazy Load Placeholder:</label>
        <img class="image-preview"
             data-default-src="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/lazy-load-placeholder.jpg"
             src="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/lazy-load-placeholder.jpg" alt="Lazy Load Placeholder"
             onerror="this.src = '<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/image-missing.jpg';"/>
        <input class="supapress-input placeholder-upload" id="lazy_load_placeholder_image"
               data-button="lazy_load_placeholder_button" type="text" placeholder="Enter a URL or upload an image"
               name="lazy_load_placeholder"
               value="<?php echo supapress_array_text( $properties, 'carousel_settings', 'lazy_load_placeholder' ); ?>"/>
        <input id="lazy_load_placeholder_button" class="upload_image_button upload-button" type="button"
               value="Upload Image"/>
    </div>
	<?php if ( ! empty( $custom_templates ) ) : ?>
        <div class="supapress-field-wrapper hide custom layout-content">
			<?php foreach ( $custom_templates as $type => $templates ) : ?>
                <div class="supapress-field-wrapper hide custom_layout_file widget-type-specific <?php echo $type; ?>">
                    <p class="supapress-tooltip-wrapper">
                        <label for="custom_template_<?php echo $type; ?>" class="supapress-label">Custom template:
                            <span class="supapress-tooltip-icon"
                                  title="Use a custom template from your theme.<br />---<br />Place your custom template file in the plugins/supapress/views/templates folder in your theme and it will appear here.<br />---<br />The file name must start: <?php echo str_replace( '_', '-', $type ); ?>-">
							<svg class="svg-icon">
								<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-tooltip"></use>
							</svg>
						</span>
                        </label>
                        <select disabled="disabled" name="custom_layout_file"
                                id="custom_layout_file_<?php echo $type; ?>" class="supapress-dropdown">
							<?php if ( $type === 'product_details' ) : ?>
                                <option value="default">Default</option>
							<?php else: ?>
                                <option value="">Please select</option>
							<?php endif; ?>
							<?php foreach ( $templates as $template ) : ?>
								<?php
								/** Since we changed to store relative paths we need to make sure that we do not unset any selected custom templates. */
								if ( strpos( $properties['custom_layout_file'], '/' ) === 0 ) :
									$selected = supapress_selected( $properties, 'custom_layout_file', ABSPATH . $template['path'] );
								else :
									$selected = supapress_selected( $properties, 'custom_layout_file', $template['path'] );
								endif;
								?>
                                <option value="<?= $template['path']; ?>" <?php echo $selected; ?>><?= $template['name']; ?></option>
							<?php endforeach; ?>
                        </select>
                    </p>
                </div>
			<?php endforeach; ?>
        </div>
	<?php endif; ?>
</div>