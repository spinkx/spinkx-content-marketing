<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo '<p>This Plugin is Licenced to -</p>';
$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
if ( $settings ) {
	echo '<p><label>Site URL</label>' . get_site_url() . '/</p>';
	echo '<p><label>Email ID</label>' . $settings['reg_email'] . '</p>';
	echo '<p><label>Valid Till</label>' . $settings['due_date'] . '</p>';
}
?>
<p style="display:none;"><button class="btn btn-info">Renew</button></p>
