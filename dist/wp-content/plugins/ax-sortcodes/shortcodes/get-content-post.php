<?php

function get_content_post($atts)
{
	$exclude = [];
	global $post;

	$atts = shortcode_atts(array(
		'id' => '',
	), $atts);

	$args = [
		'id' => $atts['id']
	];
	$post_one = get_post($args['id']);

	if(!$post)
		return;

	$out = '';

	ob_start();
	foreach( $post_one as $post ) {
		setup_postdata($post);
		the_content();
	}

	wp_reset_postdata();

	//$post->post_content);
	$out = ob_get_clean();

	$pattern = '/<p>Добро пожаловать на.+затем пишите!<\/p>/i';

	$replac = preg_replace($pattern, '', $out);
	//var_dump_pre($replac);

	return $replac;
}

add_shortcode('get_content_post', 'get_content_post');

?>