<?php
/**
 * Outputs the export options at Import & Export > Export
 *
 * @package Social_Post_Flow
 * @author Social Post Flow
 */

?>
<div class="wpzinc-option">
	<div class="left">
		<label for="access_token"><?php esc_html_e( 'Authentication Token', 'page-generator-pro' ); ?></label>
	</div>
	<div class="right">
		<input type="checkbox" name="access_token" id="access_token" value="1" checked />
        <p class="description"><?php esc_html_e( 'If enabled, includes the connection token for the account %s in the configuration file.', 'social-post-flow' ); ?></p>
	</div>
</div>

<div class="wpzinc-option">
    <div class="left">
        <label><?php esc_html_e( 'Settings', 'page-generator-pro' ); ?></label><br />
        <a href="#" class="wpzinc-checkbox-toggle" data-target="settings"><?php esc_html_e( 'Select / Deselect All', 'page-generator-pro' ); ?></a>
    </div>
    <div class="right">
        <div class="tax-selection">
            <div class="tabs-panel">
                <ul class="categorychecklist form-no-clear">				                    			
                    <?php
                    foreach ( $settings_sections as $settings_section ) {
                        ?>
                        <li>
                            <label class="selectit">
                                <input type="checkbox" name="settings[<?php echo esc_attr( $settings_section['id'] ); ?>]" value="1" class="settings" checked />
                                <?php echo esc_html( $settings_section['label'] ); ?>      
                            </label>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="wpzinc-option">
    <div class="left">
        <label><?php esc_html_e( 'Post Types Configuration', 'page-generator-pro' ); ?></label><br />
        <a href="#" class="wpzinc-checkbox-toggle" data-target="post_types"><?php esc_html_e( 'Select / Deselect All', 'page-generator-pro' ); ?></a>
    </div>
    <div class="right">
        <div class="tax-selection">
            <div class="tabs-panel">
                <ul class="categorychecklist form-no-clear">				                    			
                    <?php
                    foreach ( $post_types as $post_type ) {
                        ?>
                        <li>
                            <label class="selectit">
                                <input type="checkbox" name="post_types[<?php echo esc_attr( $post_type->name ); ?>]" value="1" class="post_types" checked />
                                <?php echo esc_html( $post_type->label ); ?>      
                            </label>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="wpzinc-option">
    <div class="left">
        <label><?php esc_html_e( 'Profiles Configuration', 'page-generator-pro' ); ?></label><br />
        <a href="#" class="wpzinc-checkbox-toggle" data-target="profiles"><?php esc_html_e( 'Select / Deselect All', 'page-generator-pro' ); ?></a>
    </div>
    <div class="right">
        <div class="tax-selection">
            <div class="tabs-panel">
                <ul class="categorychecklist form-no-clear">				                    			
                    <?php
                    foreach ( $profiles as $profile ) {
                        ?>
                        <li>
                            <label class="selectit">
                                <input type="checkbox" name="profiles[<?php echo esc_attr( $profile['id'] ); ?>]" value="1" class="profiles" checked />
                                <?php echo esc_html( $profile['provider_name'] . ': ' . $profile['profile_name'] ); ?>   
                            </label>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>