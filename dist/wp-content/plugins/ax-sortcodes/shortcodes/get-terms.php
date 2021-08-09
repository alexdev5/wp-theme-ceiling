<?

function ax_get_terms( $atts ){
	global $post;

	$atts = shortcode_atts( array(
		'term' => 'types_purpose',
		'classes' => '',
		'cat' => '',
		'view' => 'terms-default',
	), $atts );

	$terms = get_terms(
		[
			'taxonomy'   => $atts['term'],
			'hide_empty' => false,
			'hierarchical' => false,
			'orderby' => 'name',
			'order' => 'ASC',
			'exclude' => [15],
			'suppress_filters'=> false,
		]);

	$out = '';
	ob_start();
	require  (AXSHORTCODES . 'tamplate'.DIRECTORY_SEPARATOR. $atts['view'] . '.php');
	$out .= ob_get_clean();


	return $out;
}
add_shortcode( 'get_full_terms' , 'ax_get_terms' );

