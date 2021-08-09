<?php
if (is_admin()){
	require_once get_theme_file_path('inc/admin-scripts.php');
}

require_once 'inc/class-astra-loop.php';

require_once 'inc/function-parent-predefined.php';
require_once 'inc/filters.php';
require_once 'inc/actions.php';

require_once 'plugins/kama-thumbnail/kama_thumbnail.php';

if (!function_exists('wp_enqueue_script_version')){
	function wp_enqueue_script_version($handle, $src, $depend = [], $in_footer=false){
		wp_enqueue_script( $handle, get_stylesheet_directory_uri() . $src, $depend, filemtime(get_theme_file_path($src)), $in_footer );
	}
}

if (!function_exists('wp_enqueue_style_version')){
	function wp_enqueue_style_version($handle, $src, $depend = [], $in_footer=false){
		wp_enqueue_style( $handle, get_stylesheet_directory_uri() . $src, $depend, filemtime(get_theme_file_path($src)), $in_footer );
	}
}

add_post_type_support( 'page', 'excerpt' );

function astra_child_scripts(){
	// deregister styles
	//wp_dequeue_style('wp-block-library');
	// deregister scripts
	wp_deregister_script('jquery');

	// scripts
	wp_enqueue_style_version( 'style', '/style.css', array() );
	wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, null, true );
	wp_enqueue_script( 'jquery' );

	// bootstrap scripts
	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', false, null, true );
	wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js', false, null, true );

	wp_enqueue_script( 'inputmask', get_stylesheet_directory_uri().'/assets/js/inputmask.min.js', false, null, true );
	wp_enqueue_script( 'inputmask-binding', get_stylesheet_directory_uri().'/assets/js/inputmask.binding.js', false, null, true );

	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css');
	wp_enqueue_style( 'swiper', 'https://unpkg.com/swiper/swiper-bundle.min.css');

	/**
	 * Фоновое воспроизведение видео
	 */
	if (!axCheckOption('video_background_disabled')){
		//wp_enqueue_style( 'video-bg', get_stylesheet_directory_uri().'/assets/plugins/vidbacking-master/jquery.vidbacking.min.css');
		//wp_enqueue_script( 'video-bg', get_stylesheet_directory_uri().'/assets/plugins/vidbacking-master/jquery.vidbacking.min.js', false, null, true );
	}
	/* end */

	wp_enqueue_style_version( 'child-style', '/assets/css/custom.css', array() );
	wp_enqueue_script_version( 'child-index', '/assets/js/index.js', [], true );

	// styles
}
add_action( 'wp_enqueue_scripts', 'astra_child_scripts' );


/* ------ Языки WPML ------ */
function astrawpml_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'Языки в меню',
			'id'            => 'menu_lang',
			'description'   => 'Add widgets here.',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'astrawpml_widgets_init' );

# Добавляет SVG в список разрешенных для загрузки файлов.
add_filter( 'upload_mimes', 'svg_upload_allow' );
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

# Исправление MIME типа для SVG файлов.
add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	else
		$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if( $dosvg ){

		// разрешим
		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		// запретим
		else {
			$data['ext'] = $type_and_ext['type'] = false;
		}

	}

	return $data;
}
add_filter( 'wp_prepare_attachment_for_js', 'show_svg_in_media_library' );

# Формирует данные для отображения SVG как изображения в медиабиблиотеке.
function show_svg_in_media_library( $response ) {

	if ( $response['mime'] === 'image/svg+xml' ) {

		// С выводом названия файла
		$response['image'] = [
			'src' => $response['url'],
		];
	}

	return $response;
}

// Переопределяет настройки плагина Kama Thumbnail
// Автоматически отключают страницу опций в админке и использование опций.
add_filter( 'kama_thumb_def_options', function( $opts ){

	/* исходные, см. код плагина
	'meta_key'          => 'photo_URL', // называние мета поля записи.
	'cache_folder'      => '',          // полный путь до папки миниатюр.
	'cache_folder_url'  => '',          // URL до папки миниатюр.
	'no_photo_url'      => '',          // УРЛ на заглушку.
	'use_in_content'    => 'mini',      // искать ли класс mini у картинок в тексте, чтобы изменить их размер.
	'no_stub'           => false,       // не выводить картинку-заглушку.
	'auto_clear'        => false,       // очищать ли кэш каждые Х дней.
	'auto_clear_days'   => 7,           // каждые сколько дней очищать кэш.
	'rise_small'        => true,        // увеличить создаваемую миниатюру (ширину/высоту), если её размер меньше указанного размера.
	'quality'           => 90,          // качество создаваемых миниатюр.
	'allow_hosts'       => '',          // доступные хосты, кроме родного, через запятую. 'any' - любые хосты.
	'debug'             => 0,           // режим дебаг (для разработчиков).
	*/

	$opts['cache_folder']     = get_template_directory() . '/cache';
	$opts['cache_folder_url'] = get_template_directory_uri() .'/cache';
	$opts['no_stub']          = true;
	$opts['auto_clear']       = true;

	return $opts;
} );


require_once 'inc/content-hooks.php';
require_once 'inc/template-functions.php';
require_once 'inc/theme-options.php';
///var_dump_pre(getTaxonomyTypesPurpose());