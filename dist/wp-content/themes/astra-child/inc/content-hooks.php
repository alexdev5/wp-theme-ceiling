<?
add_filter( 'the_content', 'filter_post_content' );
function filter_post_content( $content ) {
	$post = $GLOBALS['post'];

	if (is_singular('post')){
		// the_date
		// $post->ID
		$date = get_the_date('j F Y', $post->ID);
		$content = str_replace('[the_date]', "<span class='date'>$date</span>", $content);
		$content = "<h3>{$post->post_title}</h3>" . $content;
	}

	return $content;
}