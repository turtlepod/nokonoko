<header role="banner" id="header">

	<div id="branding">

		<?php if ( current_theme_supports( 'tamatebako-logo' ) && tamatebako_logo_url() ) { ?>

			<?php if( is_front_page() && is_home() ){ ?>

				<h1 id="site-logo">
					<a rel="home" href="<?php echo esc_url( user_trailingslashit( home_url() ) ); ?>">
						<img class="logo-img" src="<?php echo esc_url( tamatebako_logo_url() ); ?>" alt="<?php echo esc_attr( strip_tags( get_bloginfo( 'name' ) ) ); ?>"/>
						<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
					</a>
				</h1>

			<?php } else { ?>

				<p id="site-logo">
					<a rel="home" href="<?php echo esc_url( user_trailingslashit( home_url() ) ); ?>">
						<img class="logo-img" src="<?php echo esc_url( tamatebako_logo_url() ); ?>" alt="<?php echo esc_attr( strip_tags( get_bloginfo( 'name' ) ) ); ?>"/>
						<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
					</a>
				</p>

			<?php } /* end logo */ ?>

		<?php } else { /* no logo */ ?>

			<?php if( is_front_page() && is_home() ){ ?>

				<h1 id="site-title"><a rel="home" href="<?php echo esc_url( user_trailingslashit( home_url() ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

			<?php } else { ?>

				<p id="site-title"><a rel="home" href="<?php echo esc_url( user_trailingslashit( home_url() ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>

			<?php } ?>

			<p id="site-description"><?php bloginfo( 'description' ); ?></p>

		<?php } /* end logo conditional */ ?>

	</div><!-- #branding -->

</header><!-- #header-->