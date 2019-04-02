<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/** @type string $action */ ?>
<div id="step2" class="step2<?php echo $action === 'edit' ? '' : ' hide'; ?>">
	<h2 class="nav-tab-wrapper">
		<a href="javascript:void(0);" data-tab="content" class="nav-tab nav-tab-active">Content</a>
		<a href="javascript:void(0);" data-tab="elements" class="nav-tab">Elements</a>
		<a href="javascript:void(0);" data-tab="arrangement" class="nav-tab">Arrangement</a>
		<a href="javascript:void(0);" data-tab="restrictions" class="nav-tab">Restrictions</a>
	</h2>
    <?php include_once SUPAPRESS_PLUGIN_DIR . '/admin/views/add-edit-partials/content.php'; ?>
    <?php include_once SUPAPRESS_PLUGIN_DIR . '/admin/views/add-edit-partials/elements.php'; ?>
    <?php include_once SUPAPRESS_PLUGIN_DIR . '/admin/views/add-edit-partials/arrangement.php'; ?>
	<?php include_once SUPAPRESS_PLUGIN_DIR . '/admin/views/add-edit-partials/restrictions.php'; ?>

	<div class="save-button-wrapper">
		<?php submit_button('Save Changes', 'save-button', 'submit', false); ?>
	</div>
</div>