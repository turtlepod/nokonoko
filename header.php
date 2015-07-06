<header role="banner" id="header">

	<div id="branding">

		<?php if ( current_theme_supports( 'custom-header' ) && get_header_image() ) { /* Custom Header */ ?>

			<h1 id="site-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="header-image" src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
					<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
				</a>
			</h1>

		<?php } else { /* No Custom Header, display default header */ ?>

			<h1 id="site-title"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>

		<?php } /* End Custom Header Check */ ?>

	</div><!-- #branding -->

</header><!-- #header-->