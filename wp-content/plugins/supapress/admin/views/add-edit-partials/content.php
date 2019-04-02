<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/** @type string $action */ ?>
<div class="content nav-tab-content">
	<div class="supapress-field-wrapper">
		<p class="green-heading">Select how you want to see your ISBN(s):</p>
	</div>
	<div class="supapress-field-wrapper">
		<label for="lookup_source" class="supapress-label">Select where your ISBN(s) come from:</label>
		<select name="lookup_source" id="lookup_source" class="supapress-dropdown">
			<option value="manual"<?php echo supapress_selected($properties, 'lookup_source', 'manual'); ?>>Manually enter single ISBN(s)</option>
			<option value="bulk"<?php echo supapress_selected($properties, 'lookup_source', 'bulk'); ?>>Manually enter bulk ISBN(s)</option>
			<option value="collection"<?php echo supapress_selected($properties, 'lookup_source', 'collection'); ?>>Display a Supafolio collection</option>
		</select>
	</div>
	<div class="hide manual lookup-source-input supapress-field-wrapper">
		<label class="supapress-label" for="isbn_lookup">Search catalogue:</label>
		<input name="isbn_lookup" class="supapress-input" id="isbn_lookup" type="text" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" placeholder="Enter product title or ISBN" />
	</div>
	<div class="hide bulk lookup-source-input supapress-field-wrapper">
		<label class="supapress-label" for="isbn_lookup_bulk">Enter ISBN(s):</label>
		<textarea name="isbn_lookup_bulk" class="supapress-input" id="isbn_lookup_bulk" type="text" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" placeholder="Enter product ISBN(s) - one per line or comma separated"></textarea>
		<a id="supapress-add-bulk-isbns-button">Add ISBN(s)</a>
	</div>
	<div class="hide bulk manual lookup-source-input supapress-field-wrapper">
		<select name="isbn_list[]" id="isbn_list" data-svg-url="<?php echo SUPAPRESS_PLUGIN_URL; ?>/admin/img/svg/sprite.svg#icon-three-squares" multiple="multiple" title="Click to select isbn">
			<?php if(isset($properties['isbn_list'])) : ?>
				<?php foreach($properties['isbn_list'] as $key => $value) : ?>
					<option <?php echo supapress_invalid_book_class($value); ?>data-isbn="<?php echo $key; ?>" value="<?php echo "{$key}|||{$value}"; ?>" selected="selected"><?php echo "{$value} ({$key})"; ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
	</div>
	<div class="hide collection lookup-source-input supapress-field-wrapper">
		<label for="lookup_collection" class="supapress-label">Select a collection:</label>
		<select name="lookup_collection" class="supapress-dropdown" id="lookup_collection" data-value="<?php echo supapress_property_value($properties, 'lookup_collection'); ?>"></select>
		<a href="#" target="_blank" class="edit-collection-button">Edit collection</a>
	</div>
</div>