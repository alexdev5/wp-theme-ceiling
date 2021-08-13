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
	 *
	 * - option_check
	 * 		- is : Отключить на мобильном
	 * 		- disableOnInteraction : Остановить при взаимодействии
	 * 		- disabledAutoplay : Остановить автопрокрутку
	 *
	 * - slide_show_effect - еффект переключения
	 *
	 * // Тип слайдера
	 * - type_slider
	 * 		- default : По умолчанию
	 *		- side_by_side : Изображение и текст рядом
	 *		- change_img_only : Слайдер изображения (текст статичный)
	 *
	 * //
 *		- autoplay_delay : Задержка
 *		- disabledPagination : отключить пагинацию
	 *
	 * // Эффект перехода
	 * - slide_show_effect
	 * 		- default: По умолчанию
	 *		- flip : Флип
	 *		- cube : Куб
	 *		- fade: Прозрачность
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

	$post = get_post($atts['id']);

	$out = '';
	ob_start();

	//foreach( $posts as $post ){
		setup_postdata($post);
		$slideView = get_field('slide_show_effect', $post->ID);

		$settings = [
			'slidesPerView'=> get_field('slidesPerView') ?? 'auto',
			'spaceBetween'=> get_field('spaceBetween') ?? '20px',
			'disableMobile'=> axCheckACF('is') ?? '',
			'disableOnInteraction'=> axCheckACF('disableOnInteraction') ?? false,
			'effect'=> $slideView,
			'autoplay'=> [
				'delay' => get_field('autoplay_delay') ?? 3000,
			]
		];

		if (axCheckACF('disabledAutoplay')){
			$settings['autoplay'] = false;
		}
		if (axCheckACF('disabledPagination')){
			$settings['pagination'] = false;
		}
		//
		$out .= view('slider/slider-container-start', [
			'settings'=>$settings,
			'atts'=>$args,
			'classes'=>get_field('and_class') . ' type_'. get_field('type_slider'),
			'editButton'=>'<a href="/wp-admin/post.php?post='.$atts['id'].'&action=edit" class="slider-edit" target="_blank">
						 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
							<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
							<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						</svg>
       </a cl>',
		]);

		require  (AXSHORTCODES . 'tamplate/custom-slider.php') ;
	//}

	$out .= ob_get_clean();
	$out .= view('slider/slider-container-end', ['data'=>['btn_alt'=> axCheckACF('alt_btn')]]);
	wp_reset_postdata();

	return $out;
}
add_shortcode('axslider', 'ax_custom_slider');
?>


