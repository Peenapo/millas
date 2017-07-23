<header id="masthead" class="site-header" role="banner">

    <div class="bw-header-cell site-branding">
		<?php Bw::logo(); ?>
	</div>

	<nav id="site-navigation" class="bw-header-cell main-navigation nav-primary" role="navigation">

		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i></i><span><?php esc_html_e('Menu', 'yago'); ?></span></button>

		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

	</nav>

	<div class="bw-header-cell bw-social-icons">
		<?php if( Bw::get_theme_option('social_header_enable') ): ?>
			<?php Bw::go_social();?>
		<?php endif; ?>
	</div>

</header>
