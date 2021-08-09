<?php
function ax_custom_slider($atts){
	global $post;

	/**
	 * custom_slider 				- сам слайдер
	 * 	- slides 						- слайд
	 * 	- slide_image 			- изображение
	 * 	- slide_header 			- Заголовок
	 * 	- slide_text 				- Текст
	 * 	- slide_video 			- Ссылка для видео
	 * 	- slide_text 				- Текст
	 * 	- slide_settings 		- Настройки
	 *
	 * - slidesPerView, spaceBetween
	 */

	$atts = shortcode_atts( array(
		'id' => '',
		'exclude' => '',
	), $atts );

	$args = [
		'post_type' => 'sliders',
		'numberposts'=> 1,
		'include'=> $atts['id'],
		'suppress_filters'=> false,
	];

	$posts = get_posts($args);

	$out = '';
	ob_start();

	foreach( $posts as $post ){
		setup_postdata($post);


		$settings = [
			'slidesPerView'=> get_field('slidesPerView') ?? 'auto',
			'spaceBetween'=> get_field('spaceBetween') ?? '20px',
			'disableMobile'=> get_field('disable_mobile')[0] ?? '',
		];
		//
		$out .= view('slider/slider-container-start', [
			'settings'=>$settings,
			'atts'=>$args,
			'classes'=>get_field('and_class'),

		]);

		require  (AXSHORTCODES . 'tamplate/custom-slider.php') ;
	}

	$out .= ob_get_clean();
	$out .= view('slider/slider-container-end', []);
	wp_reset_postdata();

	return $out;
}
add_shortcode('axslider', 'ax_custom_slider');
?>


