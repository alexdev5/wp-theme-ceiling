<?php

/*------------------ Admin Scripts ---------------------------------- */
function admin_scripts(){

	wp_enqueue_style('admin-main-style', get_stylesheet_directory_uri() . '/admin/admin-style.css');
	wp_enqueue_script( 'main-script', get_stylesheet_directory_uri() .'/admin/js/admin-main.js', [], '', true );
}
add_action( 'admin_enqueue_scripts', 'admin_scripts', 99 );

