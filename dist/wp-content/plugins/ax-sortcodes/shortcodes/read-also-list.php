<?php
function read_also($atts){
	global $post;
	$_exclude = [];

	$atts = shortcode_atts( array(
		'number_posts' => '3',
		'view_type' => 'list',
		'btn_text' => 'Перейти в блог',
		'post_type' => 'page',
		'exclude' => '',
	), $atts );

	$arr_atts_exclude = explode(',', $atts['exclude']);
	$exclude = array_merge($_exclude, $arr_atts_exclude);

	$args = [
		'post_type' => $atts['post_type'],
		'numberposts'=> $atts['number_posts'],
		'exclude'=> $exclude,
		'suppress_filters'=> false,
		'orderby' => 'date',
	];

	$posts = get_posts($args);
	$count = 0;

	$out = '<ul class="ul-circle-pink">';
	ob_start();
	foreach( $posts as $post ){
		setup_postdata($post);

		if ($atts['view_type'] == 'list'){
			require  (AXSHORTCODES . 'tamplate/tpm-read-also-list.php') ;
		}
		else{
			require  (AXSHORTCODES . 'tamplate/content-default.php') ;
		}

		if($count > $atts['number_posts']){
			break;
		}
		$count ++;

	}
	$out .= ob_get_clean();
	$out .= '</ul>';
	wp_reset_postdata();

	return $out;
}
add_shortcode('read_also', 'read_also');
?>