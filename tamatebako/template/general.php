<?php
/**
 * General Template Tags
**/


/**
 * Archive Title
 *
 * @since 0.1.0
 */
function tamatebako_archive_header(){ ?>

	<?php if ( get_the_archive_title() && !is_front_page() && !is_singular() && !is_404() ){ ?>

		<header itemtype="http://schema.org/WebPageElement" itemscope="itemscope" class="loop-meta">

			<?php the_archive_title( '<h1 itemprop="headline" class="loop-title">', '</h1>'); ?>

			<?php the_archive_description( '<div itemprop="text" class="loop-description">', '</div>' ); ?>

		</header><!-- .loop-meta -->

	<?php }  ?>

<?php
}


/**
 * Archive Footer (Pagination)
 *
 * @since 0.1.0
 */
function tamatebako_archive_footer(){ ?>

	<?php if ( is_home() || is_archive() || is_search() ){ ?>

		<?php the_posts_pagination( array(
			'mid_size' => 3,
			'prev_text' => '<span class="screen-reader-text">' . tamatebako_string( 'previous' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . tamatebako_string( 'next' ) . '</span>',
		) ); ?>

	<?php } ?>

<?php
}















