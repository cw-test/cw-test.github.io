<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** @type string $action */
/** @type bool|array $bookUrls */
?>
<div class="hide elements nav-tab-content">
    <div class="supapress-field-wrapper">
        <p class="green-heading supapress-tooltip-wrapper">
            <span>Select which fields to display:</span>
            <span class="supapress-tooltip-icon"
                  title="Use the toggles on the right to add elements to your module.<br />---<br />Once added you can control the settings of that element using the dropdowns on the left.">
				<svg class="svg-icon">
					<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-tooltip"></use>
				</svg>
			</span>
        </p>
    </div>
    <div class="config">
        <div class="hide tab-level show_filters supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Search filters' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper ">
                        <label class="supapress-label" for="filters">Filters:</label>
                        <select name="filters[]" id="filters" multiple="multiple" title="Select your filter options">
                            <option value="format"<?php echo supapress_multi_selected( $properties, 'filters', 'format' ); ?>>
                                Format
                            </option>
                            <option value="prices"<?php echo supapress_multi_selected( $properties, 'filters', 'prices' ); ?>>
                                Price
                            </option>
                            <option value="collection"<?php echo supapress_multi_selected( $properties, 'filters', 'collection' ); ?>>
                                Collection
                            </option>
                            <option value="guides"<?php echo supapress_multi_selected( $properties, 'filters', 'guides' ); ?>>
                                Guides
                            </option>
                            <option value="series"<?php echo supapress_multi_selected( $properties, 'filters', 'series' ); ?>>
                                Series
                            </option>
                            <option value="imprint"<?php echo supapress_multi_selected( $properties, 'filters', 'imprint' ); ?>>
                                Imprint
                            </option>
                            <option value="award"<?php echo supapress_multi_selected( $properties, 'filters', 'award' ); ?>>
                                Award
                            </option>
                            <option value="category"<?php echo supapress_multi_selected( $properties, 'filters', 'category' ); ?>>
                                Category
                            </option>
                            <option value="publisher"<?php echo supapress_multi_selected( $properties, 'filters', 'publisher' ); ?>>
                                Publisher
                            </option>
                            <option value="type"<?php echo supapress_multi_selected( $properties, 'filters', 'type' ); ?>>
                                Type
                            </option>
                            <option value="age"<?php echo supapress_multi_selected( $properties, 'filters', 'age' ); ?>>
                                Age
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="hide tab-level show_sort_by supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Search sort by' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper">
                        <label class="supapress-label supapress-tooltip-wrapper" for="sort_by">
                            <span>Sort by:</span>
                            <span class="supapress-tooltip-icon"
                                  title="Select which sorting options you would like available for your search.<br />---<br />You can re-order the options by dragging them, the default option should be at the top.">
								<svg class="svg-icon">
									<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-tooltip"></use>
								</svg>
							</span>
                        </label>
                        <select name="sort_by[]" id="sort_by" multiple="multiple" title="Select your sort by options">
                            <option value="relevance"<?php echo supapress_multi_selected( $properties, 'sort_by', 'relevance', supapress_set_default( $action ) ); ?>>
                                Relevance
                            </option>
                            <option value="publishdate-desc"<?php echo supapress_multi_selected( $properties, 'sort_by', 'publishdate-desc' ); ?>>
                                Newest to Oldest
                            </option>
                            <option value="publishdate-asc"<?php echo supapress_multi_selected( $properties, 'sort_by', 'publishdate-asc' ); ?>>
                                Oldest to Newest
                            </option>
                            <option value="title-az"<?php echo supapress_multi_selected( $properties, 'sort_by', 'title-az' ); ?>>
                                Title - A to Z
                            </option>
                            <option value="title-za"<?php echo supapress_multi_selected( $properties, 'sort_by', 'title-za' ); ?>>
                                Title - Z to A
                            </option>
                            <option value="price-asc"<?php echo supapress_multi_selected( $properties, 'sort_by', 'price-asc' ); ?>>
                                Price - Low to High
                            </option>
                            <option value="price-desc"<?php echo supapress_multi_selected( $properties, 'sort_by', 'price-desc' ); ?>>
                                Price - High to Low
                            </option>
                            <option value="contributor-az"<?php echo supapress_multi_selected( $properties, 'sort_by', 'contributor-az' ); ?>>
                                Author - A to Z
                            </option>
                            <option value="contributor-za"<?php echo supapress_multi_selected( $properties, 'sort_by', 'contributor-za' ); ?>>
                                Author - Z to A
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="hide tab-level show_per_page supapress-accordion-wrapper sub-content-wrapper">
			<?php
			echo supapress_get_element_template( 'Search per page' );
			$perPageOptions = supapress_property_array( $properties, 'per_page' );
			if ( empty( $perPageOptions ) && $action === 'add' ) {
				$perPageOptions = array( 5, 10, 15, 20, 25, 50, 75, 100 );
			}
			$perPageDefault = supapress_property_value( $properties, 'per_page_default' );
			if ( $perPageDefault === '' && $action === 'add' ) {
				$perPageDefault = '10';
			}
			?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper">
                        <label class="supapress-label supapress-tooltip-wrapper" for="per_page_number_input">
                            <span>Per page number:</span>
                            <span class="supapress-tooltip-icon"
                                  title="Select the number of results per page.<br />---<br />You can re-order the options by dragging them, using the default dropdown to choose which one to make the default for the site.">
								<svg class="svg-icon">
									<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-tooltip"></use>
								</svg>
							</span>
                        </label>
                        <input placeholder="Enter page number" type="text" id="per_page_input" name="per_page_input"
                               class="supapress-input numbers-only"/>
                        <button id="per_page_input_btn" href="#" class="upload-button" type="button">Add</button>
                        <select name="per_page[]" id="per_page" multiple="multiple"
                                title="Select your per page options">
							<?php
							foreach ( $perPageOptions as $perPageOption ):?>
                                <option value="<?php echo $perPageOption; ?>"
                                        selected="selected"><?php echo $perPageOption; ?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
                    <div class="supapress-field-wrapper">
                        <label class="supapress-label supapress-tooltip-wrapper" for="per_page_default">
                            Per page default:
                        </label>
                        <select name="per_page_default" id="per_page_default" title="Select your sort by default"
                                class="supapress-dropdown">
                            <option value="">No default set</option>
							<?php
							sort( $perPageOptions );
							foreach ( $perPageOptions as $perPageOption ):?>
                                <option value="<?php echo $perPageOption ?>"<?php echo $perPageDefault == $perPageOption ? 'selected="selected"' : ''; ?>><?php echo $perPageOption; ?></option>
							<?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="hide tab-level show_pagination supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Search pagination' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper">
                        <label class="supapress-label supapress-tooltip-wrapper" for="hide_1_page_pagination">Hide when
                            1 page of results:</label>
                        <div class="onoffswitch">
                            <input type="hidden" name="hide_1_page_pagination" value="off"/>
                            <input type="checkbox" name="hide_1_page_pagination" class="onoffswitch-checkbox"
                                   id="hide_1_page_pagination"<?php echo supapress_checked( $properties, 'hide_1_page_pagination' ); ?> />
                            <label class="onoffswitch-label" for="hide_1_page_pagination">
                                <span class="onoffswitch-inner" data-label-before="Yes" data-label-after="No"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hide tab-level show_result_count supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Pagination message' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper">
                        <p class="supapress-tooltip-wrapper">
                            <label class="supapress-label" for="result_count_text">
                                Text template:
                                <span class="supapress-tooltip-icon"
                                      title="The text you would like to show with this element.<br />---<br />Special placeholder %total% will be replaced with the total number of results.<br />---<br />Special placeholder %pagestart% will be replaced with the number of the first result on the current page.<br />---<br />Special placeholder %pageend% will be replaced with the number of the last result on the current page.">
									<svg class="svg-icon">
										<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-tooltip"></use>
									</svg>
								</span>
                            </label>
							<?php
							$value = supapress_property_value( $properties, 'result_count_text' );
							if ( ! $value ) :
								$value = htmlentities( SupaPress_WidgetTemplate::get_default( 'result_count_text' ) );
							endif;
							?>
                            <input type="text" id="supapress-result-count-text"
                                   data-default="<?php echo htmlentities( SupaPress_WidgetTemplate::get_default( 'result_count_text' ) ); ?>"
                                   name="result_count_text" class="supapress-input" value="<?php echo $value ?>"/>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="hide tab-level show_search_term supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Search term message' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper">
                        <p class="supapress-tooltip-wrapper">
                            <label class="supapress-label" for="search_term_text">
                                Text template:
                                <span class="supapress-tooltip-icon"
                                      title="The text you would like to show with this element.<br />---<br />Special placeholder %term% will be replaced with the search term entered by the user.">
								<svg class="svg-icon">
									<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-tooltip"></use>
								</svg>
							</span>
                            </label>
							<?php
							$value = supapress_property_value( $properties, 'search_term_text' );
							if ( ! $value ) :
								$value = htmlentities( SupaPress_WidgetTemplate::get_default( 'search_term_text' ) );
							endif;
							?>
                            <input type="text" id="supapress-search-term-text"
                                   data-default="<?php echo htmlentities( SupaPress_WidgetTemplate::get_default( 'search_term_text' ) ); ?>"
                                   name="search_term_text" class="supapress-input" value="<?php echo $value ?>"/>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="hide tab-level show_cover supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Book cover' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper">
                        <label class="supapress-label" for="cover_link">Book cover link:</label>
						<?php if ( is_string( $bookUrls ) ) : ?>
							<?php echo $bookUrls; ?>
						<?php else : ?>
                            <select class="supapress-dropdown" name="cover_link" id="cover_link"
                                    data-value="<?php echo supapress_property_value( $properties, 'cover_link' ); ?>">
								<?php echo implode( '', $bookUrls ); ?>
                            </select>
						<?php endif; ?>
                    </div>
                    <div class="supapress-field-wrapper">
                        <label class="supapress-label" for="cover_link_target">Open link in new tab:</label>
                        <div class="onoffswitch">
                            <input type="hidden" name="cover_link_target" value="off"/>
                            <input type="checkbox" name="cover_link_target" class="onoffswitch-checkbox"
                                   id="cover_link_target"<?php echo supapress_checked( $properties, 'cover_link_target' ); ?> />
                            <label class="onoffswitch-label" for="cover_link_target">
                                <span class="onoffswitch-inner" data-label-before="Yes" data-label-after="No"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hide tab-level show_title supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Title' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper">
                        <label class="supapress-label" for="title_link">Title link:</label>
						<?php if ( is_string( $bookUrls ) ) : ?>
							<?php echo $bookUrls; ?>
						<?php else: ?>
                            <select class="supapress-dropdown" name="title_link" id="title_link"
                                    data-value="<?php echo supapress_property_value( $properties, 'title_link' ); ?>">
								<?php echo implode( '', $bookUrls ); ?>
                            </select>
						<?php endif; ?>
                    </div>
                    <div class="supapress-field-wrapper">
                        <label class="supapress-label" for="title_link_target">Open link in new tab:</label>
                        <div class="onoffswitch">
                            <input type="hidden" name="title_link_target" value="off"/>
                            <input type="checkbox" name="title_link_target" class="onoffswitch-checkbox"
                                   id="title_link_target"<?php echo supapress_checked( $properties, 'title_link_target' ); ?> />
                            <label class="onoffswitch-label" for="title_link_target">
                                <span class="onoffswitch-inner" data-label-before="Yes" data-label-after="No"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
		echo supapress_get_empty_element_template( 'Subtitle', 'show_subtitle' );
		echo supapress_get_empty_element_template( 'Author name', 'show_author' );
		echo supapress_get_empty_element_template( 'Author bio', 'show_author_bio' );
		echo supapress_get_empty_element_template( 'Format', 'show_format' );
		?>
        <div class="hide tab-level show_pubdate supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Publication date' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper ">
                        <label class="supapress-label" for="pub_date_format">Date formats:</label>
                        <select name="pub_date_format" id="pub_date_format" class="supapress-dropdown">
                            <option value="Y-m-d"<?php echo supapress_selected( $properties, 'pub_date_format', 'Y-m-d' ); ?>>
                                1970-01-01
                            </option>
                            <option value="j F Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'j F Y' ); ?>>
                                31 January 1970
                            </option>
                            <option value="jS F Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'jS F Y' ); ?>>
                                31st January 1970
                            </option>
                            <option value="d/m/Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'd/m/Y' ); ?>>
                                31/01/1970
                            </option>
                            <option value="d-m-Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'd-m-Y' ); ?>>
                                31-01-1970
                            </option>
                            <option value="m/d/Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'm/d/Y' ); ?>>
                                01/31/1970
                            </option>
                            <option value="m-d-Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'm-d-Y' ); ?>>
                                01-31-1970
                            </option>
                            <option value="m/d/Y H:i:s"<?php echo supapress_selected( $properties, 'pub_date_format', 'm/d/Y H:i:s' ); ?>>
                                1/31/1970 00:00:00
                            </option>
                            <option value="F j, Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'F j, Y' ); ?>>
                                January 31, 1970
                            </option>
                            <option value="F jS, Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'F jS, Y' ); ?>>
                                January 31st, 1970
                            </option>
                            <option value="F j"<?php echo supapress_selected( $properties, 'pub_date_format', 'F j' ); ?>>
                                January 31
                            </option>
                            <option value="F jS"<?php echo supapress_selected( $properties, 'pub_date_format', 'F jS' ); ?>>
                                January 31st
                            </option>
                            <option value="jS M Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'jS M Y' ); ?>>
                                31st Jan 1970
                            </option>
                            <option value="l, j M Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'l, j M Y' ); ?>>
                                Monday, 31 Jan 1970
                            </option>
                            <option value="l, jS M Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'l, jS M Y' ); ?>>
                                Monday, 31st Jan 1970
                            </option>
                            <option value="F Y"<?php echo supapress_selected( $properties, 'pub_date_format', 'F Y' ); ?>>
                                January 1970
                            </option>
                            <option value="m/d"<?php echo supapress_selected( $properties, 'pub_date_format', 'm/d' ); ?>>
                                12/31
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
		<?php
		echo supapress_get_empty_element_template( 'Summary', 'show_summary' );
		echo supapress_get_empty_element_template( 'Description', 'show_description' );
		?>
        <div class="hide tab-level show_price supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Price' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper ">
                        <label class="supapress-label" for="price">Price locale:</label>
                        <select name="price[]" id="price" multiple="multiple" title="Click to select a price locale">
                            <option value="USD"<?php echo supapress_multi_selected( $properties, 'price', 'USD', supapress_set_default( $action ) ); ?>>
                                Price (USD)
                            </option>
                            <option value="GBP"<?php echo supapress_multi_selected( $properties, 'price', 'GBP' ); ?>>
                                Price (GBP)
                            </option>
                            <option value="CAD"<?php echo supapress_multi_selected( $properties, 'price', 'CAD' ); ?>>
                                Price (CAD)
                            </option>
                            <option value="AUD"<?php echo supapress_multi_selected( $properties, 'price', 'AUD' ); ?>>
                                Price (AUD)
                            </option>
                            <option value="NZD"<?php echo supapress_multi_selected( $properties, 'price', 'NZD' ); ?>>
                                Price (NZD)
                            </option>
                            <option value="EUR"<?php echo supapress_multi_selected( $properties, 'price', 'EUR' ); ?>>
                                Price (EUR)
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
		<?php
		echo supapress_get_empty_element_template( 'Series', 'show_series' );
		echo supapress_get_empty_element_template( 'Imprint', 'show_imprint' );
		echo supapress_get_empty_element_template( 'Publisher', 'show_publisher' );
		echo supapress_get_empty_element_template( 'ISBN-13', 'show_isbn13' );
		echo supapress_get_empty_element_template( 'Trim size', 'show_trimsize' );
		echo supapress_get_empty_element_template( 'Weight', 'show_weight' );
		echo supapress_get_empty_element_template( 'Awards', 'show_awards' );
		echo supapress_get_empty_element_template( 'Reviews', 'show_reviews' );
		echo supapress_get_empty_element_template( 'Pages', 'show_pages' );
		echo supapress_get_empty_element_template( 'Retailers', 'show_retailers' );
		?>
        <div class="hide tab-level show_sales_date supapress-accordion-wrapper sub-content-wrapper">
			<?php echo supapress_get_element_template( 'Sales date' ); ?>
            <div class="supapress-accordion-content element-config hide">
                <div class="supapress-accordion-content-inner element-config-inner">
                    <div class="supapress-field-wrapper ">
                        <label class="supapress-label" for="sales_date_format">Date formats:</label>
                        <select name="sales_date_format" id="sales_date_format" class="supapress-dropdown">
                            <option value="Y-m-d"<?php echo supapress_selected( $properties, 'sales_date_format', 'Y-m-d' ); ?>>
                                1970-01-01
                            </option>
                            <option value="j F Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'j F Y' ); ?>>
                                31 January 1970
                            </option>
                            <option value="jS F Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'jS F Y' ); ?>>
                                31st January 1970
                            </option>
                            <option value="d/m/Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'd/m/Y' ); ?>>
                                31/01/1970
                            </option>
                            <option value="d-m-Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'd-m-Y' ); ?>>
                                31-01-1970
                            </option>
                            <option value="m/d/Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'm/d/Y' ); ?>>
                                01/31/1970
                            </option>
                            <option value="m-d-Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'm-d-Y' ); ?>>
                                01-31-1970
                            </option>
                            <option value="m/d/Y H:i:s"<?php echo supapress_selected( $properties, 'sales_date_format', 'm/d/Y H:i:s' ); ?>>
                                1/31/1970 00:00:00
                            </option>
                            <option value="F j, Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'F j, Y' ); ?>>
                                January 31, 1970
                            </option>
                            <option value="F jS, Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'F jS, Y' ); ?>>
                                January 31st, 1970
                            </option>
                            <option value="F j"<?php echo supapress_selected( $properties, 'sales_date_format', 'F j' ); ?>>
                                January 31
                            </option>
                            <option value="F jS"<?php echo supapress_selected( $properties, 'sales_date_format', 'F jS' ); ?>>
                                January 31st
                            </option>
                            <option value="jS M Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'jS M Y' ); ?>>
                                31st Jan 1970
                            </option>
                            <option value="l, j M Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'l, j M Y' ); ?>>
                                Monday, 31 Jan 1970
                            </option>
                            <option value="l, jS M Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'l, jS M Y' ); ?>>
                                Monday, 31st Jan 1970
                            </option>
                            <option value="F Y"<?php echo supapress_selected( $properties, 'sales_date_format', 'F Y' ); ?>>
                                January 1970
                            </option>
                            <option value="m/d"<?php echo supapress_selected( $properties, 'sales_date_format', 'm/d' ); ?>>
                                12/31
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="selector">
		<?php
		echo supapress_get_toggle_field( 'Search filters', 'show_filters', $properties, 'search_results' );
		echo supapress_get_toggle_field( 'Search sort by', 'show_sort_by', $properties, 'search_results' );
		echo supapress_get_toggle_field( 'Search per page', 'show_per_page', $properties, 'search_results' );
		echo supapress_get_toggle_field( 'Search pagination', 'show_pagination', $properties, 'search_results' );
		echo supapress_get_toggle_field( 'Pagination message', 'show_result_count', $properties, 'search_results' );
		echo supapress_get_toggle_field( 'Search term message', 'show_search_term', $properties, 'search_results' );
		echo supapress_get_toggle_field( 'Book cover', 'show_cover', $properties, '', $action );
		echo supapress_get_toggle_field( 'Title', 'show_title', $properties, '', $action );
		echo supapress_get_toggle_field( 'Subtitle', 'show_subtitle', $properties );
		echo supapress_get_toggle_field( 'Author name', 'show_author', $properties, '', $action );
		echo supapress_get_toggle_field( 'Author bio', 'show_author_bio', $properties, '', $action );
		echo supapress_get_toggle_field( 'Format', 'show_format', $properties );
		echo supapress_get_toggle_field( 'Publication date', 'show_pubdate', $properties );
		echo supapress_get_toggle_field( 'Summary', 'show_summary', $properties );
		echo supapress_get_toggle_field( 'Description', 'show_description', $properties );
		echo supapress_get_toggle_field( 'Price', 'show_price', $properties );
		echo supapress_get_toggle_field( 'Series', 'show_series', $properties, 'product_details' );
		echo supapress_get_toggle_field( 'Imprint', 'show_imprint', $properties );
		echo supapress_get_toggle_field( 'Publisher', 'show_publisher', $properties );
		echo supapress_get_toggle_field( 'ISBN-13', 'show_isbn13', $properties );
		echo supapress_get_toggle_field( 'Trim size', 'show_trimsize', $properties, 'product_details' );
		echo supapress_get_toggle_field( 'Weight', 'show_weight', $properties, 'product_details' );
		echo supapress_get_toggle_field( 'Awards', 'show_awards', $properties, 'product_details' );
		echo supapress_get_toggle_field( 'Reviews', 'show_reviews', $properties, 'product_details' );
		echo supapress_get_toggle_field( 'Pages', 'show_pages', $properties );
		echo supapress_get_toggle_field( 'Retailers', 'show_retailers', $properties, 'product_details' );
		echo supapress_get_toggle_field( 'Sales date', 'show_sales_date', $properties );
		?>
    </div>
</div>
