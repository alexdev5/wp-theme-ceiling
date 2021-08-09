<?

add_action( 'astra_template_parts_content', 'remove_template_parts_post' );

function remove_template_parts_post() {

}

// Классы для бади
function astra_primary_class( $class = '' ) {
	echo 'class="' . esc_attr( join( ' ', astra_get_primary_class( $class ) ) ) . '"';
}


/**
 * Archive Page Title
 * \astra\inc\core\common-functions.php
 */
if ( ! function_exists( 'astra_archive_page_info' ) ) {

	/**
	 * Wrapper function for the_title()
	 *
	 * Displays title only if the page title bar is disabled.
	 */
	function astra_archive_page_info() {

//return '';

		if ( apply_filters( 'astra_the_title_enabled', true ) ) {

			// Author.
			if ( is_author() ) { ?>

				<section class="ast-author-box ast-archive-description">
					<div class="ast-author-bio">
						<?php do_action( 'astra_before_archive_title' ); ?>
						<h1 class='page-title ast-archive-title'><?php echo get_the_author(); ?></h1>
						<?php do_action( 'astra_after_archive_title' ); ?>
						<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
						<?php do_action( 'astra_after_archive_description' ); ?>
					</div>
					<div class="ast-author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'email' ), 120 ); ?>
					</div>
				</section>

				<?php

				// Category.
			} elseif ( is_category() ) {
				?>

				<section class="ast-archive-description">
					<?php do_action( 'astra_before_archive_title' ); ?>
					<?php do_action( 'astra_after_archive_title' ); ?>
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
					<?php do_action( 'astra_after_archive_description' ); ?>
				</section>

				<?php

				// Tag.
			} elseif ( is_tag() ) {
				?>

				<section class="ast-archive-description">
					<?php do_action( 'astra_before_archive_title' ); ?>
					
					<?php do_action( 'astra_after_archive_title' ); ?>
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
					<?php do_action( 'astra_after_archive_description' ); ?>
				</section>

				<?php

				// Search.
			} elseif ( is_search() ) {
				?>

				<section class="ast-archive-description">
					<?php do_action( 'astra_before_archive_title' ); ?>
					<?php
						/* translators: 1: search string */
						$title = apply_filters( 'astra_the_search_page_title', sprintf( __( 'Search Results for: %s', 'astra' ), '<span>' . get_search_query() . '</span>' ) );
					?>
					<h1 class="page-title ast-archive-title"> <?php echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </h1>
					<?php do_action( 'astra_after_archive_title' ); ?>
				</section>

				<?php

				// Other.
			} else {
				?>

				<section class="ast-archive-description">
					<?php do_action( 'astra_before_archive_title' ); ?>
					<?php the_archive_title( '<h1 class="page-title ast-archive-title">', '</h1>' ); ?>
					<?php do_action( 'astra_after_archive_title' ); ?>
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
					<?php do_action( 'astra_after_archive_description' ); ?>
				</section>

				<?php
			}
		}
	}

	add_action( 'astra_archive_header', 'astra_archive_page_info' );
}

/**

*/
add_action( 'wp_loaded', function(){

	remove_action( 'astra_template_parts_content_top', array( 'Astra_Loop', 'astra_templat_part_wrap_open' ), 25 );
	remove_action( 'astra_template_parts_content_bottom', array( 'Astra_Loop', 'astra_templat_part_wrap_close' ), 5 );
} );

