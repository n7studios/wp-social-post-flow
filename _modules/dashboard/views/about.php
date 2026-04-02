<?php
/**
 * Outputs the About section, comprising of other Plugins.
 *
 * @package WPZincDashboardWidget
 * @author WP Zinc
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wpzinc-about">
	<h3>Our Products</h3>

	<p class="description">
		If you found this Plugin useful, you may also like our other products.
	</p>

	<br />

	<div class="plugin-install-php">
		<?php
		foreach ( $products as $product ) {
			include $this->dashboard_folder . '/views/about-plugin-card.php';
		}
		?>
	</div>
</div>

