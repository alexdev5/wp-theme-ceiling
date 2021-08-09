<?php


function ax_shortcodes_get_filter( $atts ){
	global $post;
	$atts = shortcode_atts( array(
		'num' => 4,
		'cat' => '',
	), $atts );

	// тип недвижимости
	$terms_type_properties = get_terms(
		[
			'taxonomy'   => 'type_property',
			'hide_empty' => false,
			'hierarchical' => false,
			'orderby' => 'name',
			'order' => 'ASC',
		]
	);

	// тип недвижимости
	$terms_type_areas = get_terms(
		[
			'taxonomy'   => 'areas_on_the_ground',
			'hide_empty' => false,
			'hierarchical' => false,
			'orderby' => 'name',
			'order' => 'ASC',
		]
	);

	// acf filters

	$out = '';
	ob_start();
	/*foreach( $posts as $post ){
		setup_postdata($post);*/
	require (AXSHORTCODES . 'tamplate'.DIRECTORY_SEPARATOR.'tmp-get-filter.php');
	//}
	$out .= ob_get_clean();
	//wp_reset_postdata();

	return $out;
}
add_shortcode( 'get_filter_pre' , 'ax_shortcodes_get_filter' );


/*
 * Запрост через рест апи
 * Регистрирует маршрут
 * */
add_action( 'rest_api_init', function () {
	register_rest_route( 'property/v1', '/filter/', array(
		'methods'  => 'GET',
		'callback' => 'my_awesome_func',
	) );
} );

// Обрабатывает запрос
function my_awesome_func( WP_REST_Request $request ) {
	$tax_type = '';
	$tax_area = '';

	// тип недвижимости
	if($request->get_param('type_property')){
		$tax_type = implode(' ', $request->get_param('type_property'));
	}
	// районы
	if($request->get_param('areas_on_the_ground')){
		$tax_area = implode(' ', $request->get_param('areas_on_the_ground'));
	}

	$query = new WP_Query([
		'posts_per_page'=> '',
		'post_type' => 'real_property',
		'type_property' => $tax_type,
		'areas_on_the_ground' => $tax_area,
		'meta_query' => [
			[
				'key' => 'property_price',
				'value' => [760000, 780000],
				'compare' => 'BETWEEN'
			],
			[
				'key' => 'property_house_area',
				'value' => [1, 23],
				'compare' => 'BETWEEN'
			],

			/*'book_color' => [
				'key'     => 'color',
				'value'   => 'blue',
				'compare' => 'NOT LIKE',
			],*/

		]
	]);

	/*if ( empty( $posts ) )
		return new WP_Error( 'no_author_posts', 'Записей не найдено', array( 'status' => 404 ) );*/

	//return $query->posts;
	return $query->post_count;
}
