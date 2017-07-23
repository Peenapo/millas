<heading class="bwg-heading">
    <?php $theme_info = Bw::$theme; ?>
    <h1><?php printf( esc_html__( "Welcome to %s %s", 'yago' ), $theme_info->get('Name'), $theme_info->get('Version') ); ?></h1>
    <p><?php esc_html_e('Use the steps below to start building your new website. If you have any questions please review the online documentation or submit a new support ticket. We will be happy to help.', 'yago'); ?></p>
    <a href="http://peenapo.com/docs/<?php echo Bw::$theme_prefix; ?>" target="_blank" class="bwg-button button button-secondary"><?php esc_html_e('Online documentation', 'yago'); ?></a>&nbsp;
    <a href="http://peenapo.ticksy.com/" target="_blank" class="bwg-button button button-secondary"><?php esc_html_e('Submit a ticket', 'yago'); ?></a>
</heading>
