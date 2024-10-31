<?php

/**a
 * Provide a view for a section
 *
 * Enter text below to appear below the section title on the Settings page
 *
 * @link       https://www.wpconcierges.com/plugins/renoon_tracking/
 * @since      1.0.0
 *
 * @package    renoon_tracking
 * @subpackage renoon_tracking/admin/partials
 */
 $plugin_url =  plugins_url();
 $logo = $plugin_url."/renoon-tracking-pro/assets/renoon-logo.png";
 settings_errors();
?>
<img src="<?php echo $logo;?>" border="0" width="150px">
<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
<form method="post" action="options.php"><?php

settings_fields( $this->plugin_name . '-options' );

do_settings_sections( $this->plugin_name );

submit_button( 'Save Settings' );

?></form>