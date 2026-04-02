<?php
/**
 * Outputs a Plugin Card.
 *
 * @package WPZincDashboardWidget
 * @author WP Zinc
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="plugin-card">
	<div class="plugin-card-top">
		<div class="name column-name">
			<h3>
				<a href="<?php echo esc_url( $product['url'] ); ?>" target="_blank">
					<?php echo esc_html( $product['name'] ); ?>
					<img src="<?php echo esc_url( $product['icon'] ); ?>" class="plugin-icon" alt="">
				</a>
			</h3>
		</div>
		<div class="desc column-description">
			<p><?php echo esc_html( $product['description'] ); ?></p>
		</div>
	</div>

	<div class="plugin-card-bottom">
		<div class="vers column-rating">
			from $<?php echo esc_html( $product['price'] ); ?>/year
		</div>
		<div class="column-updated">
			<?php
			if ( array_key_exists( 'install_url', $product ) && ! empty( $product['install_url'] ) ) {
				?>
				<a href="<?php echo esc_url( $product['install_url'] ); ?>" class="button button-primary" target="_blank">Install</a>
				<?php
			}
			?>
			<a href="<?php echo esc_url( $product['url'] ); ?>" class="button button-secondary" target="_blank">Learn More</a>
		</div>
	</div>
</div>