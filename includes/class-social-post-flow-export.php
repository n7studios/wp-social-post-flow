<?php
/**
 * Export class.
 *
 * @package Social_Post_Flow
 * @author Social Post Flow
 */

/**
 * Exports settings to a JSON or ZIP file, for use on other
 * Plugin installations.
 *
 * @package Social_Post_Flow
 * @author  Social Post Flow
 */
class Social_Post_Flow_Export {

	/**
	 * Constructor.
	 *
	 * @since   1.0.0
	 */
	public function __construct() {

		// Export.
		add_action( 'social_post_flow_export_view', array( $this, 'output_export_options' ) );
		add_action( 'social_post_flow_export', array( $this, 'export' ), 10, 2 );

	}

	/**
	 * Outputs options on the Export screen to choose what data to include
	 * in the export
	 *
	 * @since   1.2.9
	 */
	public function output_export_options() {

		// Get Settings Sections, Post Types and Profiles.
		$settings_sections = array(
			array(
				'id' => 'general',
				'label' => __( 'General', 'social-post-flow' ),
			),
			array(
				'id' => 'text_to_image',
				'label' => __( 'Text to Image', 'social-post-flow' ),
			),
			array(
				'id' => 'log',
				'label' => __( 'Log', 'social-post-flow' ),
			),
			array(
				'id' => 'repost',
				'label' => __( 'Repost', 'social-post-flow' ),
			),
			array(
				'id' => 'user_access',
				'label' => __( 'User Access', 'social-post-flow' ),
			),
			array(
				'id' => 'custom_tags',
				'label' => __( 'Custom Tags', 'social-post-flow' ),
			),
		);
		$post_types = social_post_flow()->get_class( 'common' )->get_post_types();
		$profiles = social_post_flow()->get_class( 'api' )->profiles( false, social_post_flow()->get_class( 'common' )->get_transient_expiration_time() );

		// Load view.
		include_once SOCIAL_POST_FLOW_PLUGIN_PATH . 'views/export.php';

	}

	/**
	 * Export data
	 *
	 * @since   1.0.0
	 *
	 * @param   array $data   Export Data.
	 * @param   array $params Export Parameters (define what data to export).
	 * @return  array           Export Data
	 */
	public function export( $data, $params ) {

		// Get all settings.
		$settings = social_post_flow()->get_class( 'settings' )->get_all();

		// Get Post Types and Profiles.
		$post_types = social_post_flow()->get_class( 'common' )->get_post_types();
		$profiles = social_post_flow()->get_class( 'api' )->profiles( false, social_post_flow()->get_class( 'common' )->get_transient_expiration_time() );
		$profile_ids = array_keys( $profiles );

		// Depending on the Export sections selected, remove settings.
		
		// Authentication.
		if ( ! array_key_exists( 'access_token', $params ) ) {
			unset( $settings['social-post-flow-access-token'] );
			unset( $settings['social-post-flow-refresh-token'] );
			unset( $settings['social-post-flow-token-expires'] );
		}

		// Settings.
		if ( ! array_key_exists( 'settings', $params ) ) {
			// General.
			unset( $settings['social-post-flow-test_mode'] );
			unset( $settings['social-post-flow-cron'] );
			unset( $settings['social-post-flow-cron_delay'] );
			unset( $settings['social-post-flow-disable_excerpt_fallback'] );
			unset( $settings['social-post-flow-override'] );

			// Text to Image.
			unset( $settings['social-post-flow-text_to_image'] );

			// Log Settings.
			unset( $settings['social-post-flow-log'] );

			// Repost Settings.
			unset( $settings['social-post-flow-repost'] );
			unset( $settings['social-post-flow-repost_disable_cron'] );
			unset( $settings['social-post-flow-repost_time'] );

			// User Access.
			unset( $settings['social-post-flow-hide_meta_box_by_roles'] );
			unset( $settings['social-post-flow-restrict_post_types'] );
			unset( $settings['social-post-flow-restrict_roles'] );
			unset( $settings['social-post-flow-roles'] );

			// Custom Tags.
			unset( $settings['social-post-flow-custom_tags'] );
		} else {
			// General.
			if ( ! array_key_exists( 'general', $params['settings'] ) ) {
				unset( $settings['social-post-flow-test_mode'] );
				unset( $settings['social-post-flow-cron'] );
				unset( $settings['social-post-flow-cron_delay'] );
				unset( $settings['social-post-flow-disable_excerpt_fallback'] );
				unset( $settings['social-post-flow-override'] );
			}

			// Text to Image.
			if ( ! array_key_exists( 'text_to_image', $params['settings'] ) ) {
				unset( $settings['social-post-flow-text_to_image'] );
			}

			// Log Settings.
			if ( ! array_key_exists( 'log', $params['settings'] ) ) {
				unset( $settings['social-post-flow-log'] );
			}

			// Repost Settings.
			if ( ! array_key_exists( 'repost', $params['settings'] ) ) {
				unset( $settings['social-post-flow-repost'] );
				unset( $settings['social-post-flow-repost_disable_cron'] );
				unset( $settings['social-post-flow-repost_time'] );
			}
			
			// User Access.
			if ( ! array_key_exists( 'user_access', $params['settings'] ) ) {
				unset( $settings['social-post-flow-hide_meta_box_by_roles'] );
				unset( $settings['social-post-flow-restrict_post_types'] );
				unset( $settings['social-post-flow-restrict_roles'] );
				unset( $settings['social-post-flow-roles'] );
			}
			
			// Custom Tags.
			if ( ! array_key_exists( 'custom_tags', $params['settings'] ) ) {
				unset( $settings['social-post-flow-custom_tags'] );
			}
		}

		// Post Types.
		if ( ! array_key_exists( 'post_types', $params ) ) {
			foreach ( $post_types as $post_type ) {
				unset( $settings[ 'social-post-flow-' . $post_type->name ] );
			}

			// Return the settings.
			// Removing Profiles from Post Type settings isn't needed, as there are no Post Type settings.
			die('no post types to return');
			return $settings;
		}

		// Remove some Post Type settings based on the selected Post Types.
		foreach ( $post_types as $post_type ) {
			if ( ! array_key_exists( $post_type->name, $params['post_types'] ) ) {
				var_dump( $post_type->name . ' excluded in export' );
				unset( $settings[ 'social-post-flow-' . $post_type->name ] );
			}
		}

		// Profiles.
		// Removes Post Type Settings by Profile.
		if ( ! array_key_exists( 'profiles', $params ) ) {
			// Remove all Post Type Profile settings.
			foreach ( $post_types as $post_type ) {
				// Skip if the settings for this Post Type were not included
				// in the export.
				if ( ! array_key_exists( 'social-post-flow-' . $post_type->name, $settings ) ) {
					var_dump( $post_type->name . ' excluded in export' );
					continue;
				}

				// Skip if the settings for this Post Type are false.
				// This means no settings have been set for this Post Type.
				if ( ! $settings[ 'social-post-flow-' . $post_type->name ] ) {
					var_dump( $post_type->name . ' no settings' );
					continue;
				}

				// Remove settings for all Profiles for this Post Type.
				foreach( $profile_ids as $profile_id ) {
					unset( $settings[ 'social-post-flow-' . $post_type->name ][ $profile_id ] );
				}
			}

			return $settings;
		}
		
		// Remove some Post Type Profile settings based on the selected Profiles.
		foreach ( $post_types as $post_type ) {
			// Skip if the settings for this Post Type are false.
			// This means no settings have been set for this Post Type.
			if ( ! $settings[ 'social-post-flow-' . $post_type->name ] ) {
				continue;
			}

			// @TODO.
		}
		

		var_dump( $settings );
		die();

		return $settings;

	}

}
