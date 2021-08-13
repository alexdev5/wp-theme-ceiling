<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

?>

<section class="no-results not-found">
	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
			<?php
				printf(
					wp_kses(
						/* translators: 1: link to new post */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'astra' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p><?php echo esc_html( astra_default_strings( 'string-search-nothing-found-message', false ) ); ?></p>
		<?php else : ?>
      <? $args = [
            'post_type' => 'ceilings',
            'numberposts'=> 1,
            'suppress_filters'=> false,
            'orderby' => 'date',
            'posts_per_page' => 1,
            'tax_query'      => array(
               array(
                  'taxonomy' => 'types_purpose',
                  'terms' => array('no'),
                  'field' => 'slug',
                  'operator' => 'IN',
               ),
            )
         ];
         $wp_query = new WP_Query($args);
				while ( $wp_query->have_posts() ){
					$wp_query->the_post();
					require __DIR__ . '/inc/celling-no-content.php';
				}
         ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
