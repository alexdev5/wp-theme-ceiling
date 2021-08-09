<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
<?php 
	astra_content_after();
		
	astra_footer_before();
		
	astra_footer();
		
	astra_footer_after(); 
?>
	</div><!-- #page -->
<?php
	astra_body_bottom();

	// Заказать
	if (axGetOption('shortcode_cf7')){
		 echo do_shortcode(axGetOption('shortcode_cf7'));
   } else{
		 if (ICL_LANGUAGE_CODE=='uk'){
			 echo do_shortcode('[contact-form-7 id="416" title="Заказать uk"]');
		 } else{
			 echo do_shortcode('[contact-form-7 id="373" title="Заказать ru"]');
		 }
   }

	// Заказать звонок
   if (axGetOption('shortcode_cf7_call')){
		 echo do_shortcode(axGetOption('shortcode_cf7_call'));
   } else{
      if (ICL_LANGUAGE_CODE=='uk'){
				echo do_shortcode('[contact-form-7 id="418" title="Заказать звонок uk"]');
      } else{
				echo do_shortcode('[contact-form-7 id="417" title="Заказать звонок ru"]');
      }
   }



   axGetOption('code_footer');
	wp_footer();

?>



	</body>
</html>
