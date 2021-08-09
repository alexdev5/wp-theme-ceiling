<?php

// Вывод событий (новостей) по шорткоду
function portfolio_grid( $atts ){
	global $wp_query;

	$_exclude = [];
	$atts = shortcode_atts( array(
		'num' => 6,
		'is_nav' => false,
		'view' => 'portfolio-grid',
		'col' => '12',
		'btn_text' => 'Подробнее',
		'load_text' => 'Больше статей',
		'post_type' => 'portfolio',
		'exclude' => '',
		'cat' => '',
	), $atts );

	$arr_atts_exclude = explode(',', $atts['exclude']);
	$exclude = array_merge($_exclude, $arr_atts_exclude);

	// portfolio_grid
	$args = [
		'post_type' => $atts['post_type'],
		//'numberposts'=> $atts['num'],
		'exclude'=> $exclude,
		'suppress_filters'=> false,
		'orderby' => 'date',
		'posts_per_page' => $atts['num'],
		'category_name' => $atts['cat'],
		'tax_query'      => array(
			array(
				'taxonomy' => 'types_purpose',
				'terms' => array('no'),
				'field' => 'slug',
				'operator' => 'NOT IN',
			),
		),
		'paged'          => get_query_var('paged') ?: 1,
	];
	$wp_query = new WP_Query($args);

	$_count = 1;

	$settings = [
		'slidesPerView'=> get_field('slidesPerView') ?? 'auto',
		'spaceBetween'=> get_field('spaceBetween') ?? '20px',
	];

	// Container shortcode start
	$out = view('inc/container-start', ['atts'=>$atts, 'settings'=>$settings]);
	//

	/*if ($atts['view']=='portfolio-slider'){
		$out = view('slider/slider-container-start', []);
	} else{
		$out = '<div class="portfolio-grid row">';
	}*/

	$file = AXSHORTCODES . 'tamplate'.DIRECTORY_SEPARATOR. $atts['view'] . '.php';
	if (!file_exists($file)){
		echo'file_not_exist';
		return;
	}

	ob_start();

	while ( $wp_query->have_posts() ){
		$wp_query->the_post();
		require $file;
		$_count ++;
	}
	// Для слайдера
	$out .= ob_get_clean();

	// Container shortcode end
	$out .= view('inc/container-end', ['atts'=>$atts]);
	//

	/*// Для слайдера
	if ($atts['view']=='portfolio-slider') {
		$out .= view('slider/slider-container-end');
	} else{
		$out .= '</div>';
	}*/


	/*
	 * Pagination
	 * */
	if ($atts['is_nav']>0){
		ob_start();
		the_posts_pagination();
		//echo kama_pagenavi('');
		$out .= ob_get_clean();
	}

	wp_reset_query();
	return $out;
}

add_shortcode( 'portfolio_grid' , 'portfolio_grid' );

?>