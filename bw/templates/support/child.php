<div class="bwg-alert<?php if( Bw::$child_theme->parent() ) { echo ' bwg-alert-success'; } ?>">
    <strong data-complete="<?php echo Bw_guide::get_string('complete'); ?>"><?php echo Bw::$child_theme->parent() ? Bw_guide::get_string('complete') : Bw_guide::get_string('not_complete'); ?></strong>
</div>
<div class="bwg-tab-content">
    <h3><?php esc_html_e('Install a Child Theme', 'yago'); ?></h3>
    <p>
        <?php esc_html_e('A child theme is a theme that inherits the functionality and styling of another theme, called the parent theme. Child themes are the recommended way of modifying an existing theme.', 'yago'); ?>
    </p>
    <p><?php esc_html_e('There are a few reasons why you would want to use a child theme:', 'yago'); ?></p>
    <ul>
        <li><?php esc_html_e('If you modify a theme directly and it is updated, then your modifications may be lost. By using a child theme you will ensure that your modifications are preserved.', 'yago'); ?></li>
        <li><?php esc_html_e('Using a child theme can speed up development time.', 'yago'); ?></li>
        <li><?php esc_html_e('Using a child theme is a great way to learn about WordPress theme development.', 'yago'); ?></li>
    </ul><br>
    <?php if( ! Bw::$child_theme->parent() ): ?>
        <a href="#" id="bwg-do-child" class="bwg-button button button-primary" data-complete="<?php esc_html_e('Child Theme Installed', 'yago'); ?>"><?php esc_html_e('Install a Child Theme', 'yago'); ?></a>
    <?php else: ?>
        <a href="#" class="bwg-button button button-primary" disabled="disabled"><?php esc_html_e('Child Theme Installed', 'yago'); ?></a>
    <?php endif; ?>
</div>
