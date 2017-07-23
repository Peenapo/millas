<?php global $tgmpa; ?>
<div class="bwg-alert<?php if( $tgmpa->is_tgmpa_required_complete() ) { echo ' bwg-alert-success'; } ?>">
    <strong><?php echo $tgmpa->is_tgmpa_required_complete() ? Bw_guide::get_string('complete') : Bw_guide::get_string('not_complete'); ?></strong>
</div>
<div class="bwg-tab-content">
    <h3><?php esc_html_e('Install Required Plugins', 'yago'); ?></h3>
    <p><?php printf( esc_html__( "A plugin is a piece of software that can extend functionality or add new features to your WordPress websites. Before you can use all the cool stuff of %s you must first install the required plugins.", 'yago' ), Bw::$theme->get('Name') ); ?></p>
    <?php
        if( ! $tgmpa->is_tgmpa_required_complete() ) {
            echo '<ol class="bwg-required-plugins-list">';
            foreach ( $tgmpa->plugins as $slug => $plugin ) {
                if ( $plugin['required'] and ! $tgmpa->is_plugin_active( $slug ) ) {
                    echo '<li>' . $plugin['name'] . '</li>';
                }
            }
            echo '</ol>';
        }
    ?>
    <?php if( is_object( $tgmpa ) and method_exists( 'TGM_Plugin_Activation', 'get_tgmpa_url' ) ): ?>
        <?php if( ! $tgmpa->is_tgmpa_required_complete() ): ?>
            <a href="<?php echo esc_url( $tgmpa->get_tgmpa_url() ); ?>" class="bwg-button button button-primary"><?php esc_html_e('Install Plugins', 'yago'); ?></a>
        <?php else: ?>
            <a href="#" class="bwg-button button button-primary" disabled="disabled"><?php esc_html_e('Plugins Installed', 'yago'); ?></a>
        <?php endif; ?>
    <?php endif; ?>
</div>
