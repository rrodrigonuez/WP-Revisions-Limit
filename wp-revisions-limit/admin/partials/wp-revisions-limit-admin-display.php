<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp_Revisions_Limit
 * @subpackage Wp_Revisions_Limit/admin/partials
 */
?>
<?php
$this->load_options();
?>
<div class="wrap">
    <h2>WP Revisions Limit</h2>           
    <form method="post" action="options.php">
    <?php
        // This prints out all hidden setting fields
        settings_fields( 'wp_revisions_limit_group' );
        do_settings_sections( $this->plugin_name );
        submit_button();
    ?>
    </form>
</div>