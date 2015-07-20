<header role="banner" id="header">

	<div id="branding">

		<?php if ( current_theme_supports( 'tamatebako-logo' ) && get_theme_mod( 'logo' ) ) { ?>

			<h1 id="site-logo">
				<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img class="logo-img" src="<?php echo esc_url( tamatebako_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
					<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
				</a>
			</h1>

		<?php } else { ?>

			<h1 id="site-title"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>

		<?php } /* End If */ ?>

	</div><!-- #branding -->

</header><!-- #header-->