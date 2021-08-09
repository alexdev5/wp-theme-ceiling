<?php

add_action('astra_template_parts_content_top', function(){
	do_action( 'astra_before_archive_title' );
	/* Выбраный вид потолков */
	if (get_query_var('taxonomy')==='types_purpose') {
		echo '<h2 class="before-line">' . single_cat_title('', 0) . '</h2><div class="post-grid grid-image row"> ';
	}
	//
});

add_action('astra_template_parts_content_bottom', function(){
	/* Выбраный вид потолков */
	if (get_query_var('taxonomy')==='types_purpose') {
		echo '</div>';
	}
	//
});


add_action( 'wp_loaded', function(){
	//remove_action('astra_template_parts_content_none', ['Astra_Loop', 'template_parts_none']);
} );

add_action('astra_template_parts_content_none', function(){
	//echo '<div>Занисей не найдено</div>';
});