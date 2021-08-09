<?php
/*
 * Plugin name: Users Functions
 * Description: Пользовательские функции, шорткоды, дополняющие функционал CMS.
 * Author:      Alex Dev
 * */
define('AXSHORTCODES', plugin_dir_path( __FILE__ ));
define('AX_JS_DIR', plugins_url('', __FILE__) . '/assets/js/');
define('AX_IMG_DIR', plugins_url('', __FILE__) . '/assets/img/');
define('AX_CSS_DIR', plugins_url('', __FILE__) . '/assets/css/');

/*if(!function_exists('is_local_user')){
	function is_local_user(){
		return wp_get_current_user()->user_login == 'admin';
	}
}*/

function ax_grid_scripts() {
	wp_enqueue_style( 'ax-post-style', AX_CSS_DIR . 'ax-main.css' );
	wp_enqueue_script( 'ax-post-grid', AX_JS_DIR . 'ax-main.js', ['jquery'], '', true);
	wp_localize_script('ax-post-grid', 'makeeScript', [
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce'=> wp_create_nonce('makee-script')
	]);

}

require_once AXSHORTCODES . 'inc/functions.php';
require_once AXSHORTCODES . 'inc/helpers.php';
require_once AXSHORTCODES . 'inc/custom-type-post.php';

require_once AXSHORTCODES . 'shortcodes'.DIRECTORY_SEPARATOR.'get-content-post.php';
require_once AXSHORTCODES . 'shortcodes'.DIRECTORY_SEPARATOR.'post-grid.php';
require_once AXSHORTCODES . 'shortcodes'.DIRECTORY_SEPARATOR.'portfolio-grid.php';

require_once AXSHORTCODES . 'shortcodes/custom-slider.php';

//if(is_local_user())
require_once AXSHORTCODES . 'shortcodes'.DIRECTORY_SEPARATOR.'get-terms.php';
require_once AXSHORTCODES . 'inc/ajax.php';

add_action('wp_enqueue_scripts', 'ax_grid_scripts');


