<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/** @type string $action */
/** @type SupaPress_Widget $post */
?>
<div id="step1" class="step1<?php echo $action === 'edit' ? ' hide' : ''; ?>">
	<input name="action" type="hidden" value="<?php echo $action; ?>" />
	<?php if($action === 'edit') : ?>
		<input name="postId" type="hidden" value="<?php echo $post->id(); ?>" />
	<?php endif; ?>
	<div class="supapress-field-wrapper widget-title-wrapper">
		<p><label class="supapress-label" for="widget-title">Module title</label></p>
		<input name="title" id="widget-title" class="supapress-input" type="text" placeholder="Enter a name for your module" size="80" value="<?php echo $action === 'edit' ? esc_attr( $post->title() ) : ""; ?>" />
	</div>
	<div class="supapress-field-wrapper widget-type-field-wrapper">
		<p class="supapress-label widget-type-heading">Choose a module type</p>
		<div class="widget-type-wrapper">
			<input name="widget_type" id="isbn_lookup_widget" type="radio" value="isbn_lookup"<?php echo supapress_radio_checked($properties, 'widget_type', 'isbn_lookup', supapress_set_default($action)); ?> />
			<label class="widget-type-label lookup" for="isbn_lookup_widget">
				<span class="label-content">
					<span class="widget-type-text">ISBN Lookup</span>
					<svg class="svg-icon">
						<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-lookup-icon"></use>
					</svg>
				</span>
			</label>
			<input name="widget_type" id="search_results_widget" type="radio" value="search_results"<?php echo supapress_radio_checked($properties, 'widget_type', 'search_results'); ?> />
			<label class="widget-type-label search" for="search_results_widget">
				<span class="label-content">
					<span class="widget-type-text">Search Results</span>
					<svg class="svg-icon">
						<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-search-icon"></use>
					</svg>
				</span>
			</label>
			<input name="widget_type" id="product_details_widget" type="radio" value="product_details"<?php echo supapress_radio_checked($properties, 'widget_type', 'product_details'); ?> />
			<label class="widget-type-label details" for="product_details_widget">
				<span class="label-content">
					<span class="widget-type-text">Product Details</span>
					<svg class="svg-icon">
						<use xlink:href="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-details-icon"></use>
					</svg>
				</span>
			</label>
		</div>
	</div>
	<div class="save-button-wrapper">
		<span class="save-button next-button button" id="step1_next_btn">Next</span>
	</div>
</div>