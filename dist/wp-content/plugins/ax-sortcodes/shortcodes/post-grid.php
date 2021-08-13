<?php

// Вывод событий (новостей) по шорткоду
function ax_post_grid( $atts ){
	global $wp_query;

	/**
	 * btn_text_order - текст кнопки
	 * completed_works_num - количество сделаных работ
	 * completed_works_text - текст
	 * price_ceiling - цена от (число парсится и оборачивается в <b></b>)
	 */

	$_exclude = [];
	$atts = shortcode_atts( array(
		'num' => 6,
		'view' => 'grid-image-hover',
		'is_nav' => 1,

		// Ссылки на "наши работы"
		'our_work_link' => '',
		// Текст ссылки на "наши работы"
		'our_work_link_text' => '',
		// Показывать последний блок как ссылку на все записи
		'isnt_last' => '',
		// текст последнего блока, если есть
		'last_link_text' => '',

		'last_header_text' => '',
		'last_content_text' => '',
		'more_text' => '',
		'less_text' => '',

		'col' => '4',
		'btn_text' => 'Заказать',
		'load_text' => 'Больше статей',
		'post_type' => 'page',
		'exclude' => '',
		'cat' => '',
	), $atts );

	$arr_atts_exclude = explode(',', $atts['exclude']);
	$exclude = array_merge($_exclude, $arr_atts_exclude);

	$args = [
		'post_type' => $atts['post_type'],
		'numberposts'=> $atts['num'],
		'exclude'=> $exclude,
		'suppress_filters'=> true,
		'orderby' => 'date',
		'category_name' => $atts['cat'],
		'posts_per_page' => $atts['num'],
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

	$cats = $_GET['f'];
	if ($cats){
		$args['types_purpose'] = $cats;
	}

	$wp_query = new WP_Query($args);

	$count = 1;
	$postAll = $wp_query->found_posts;
	$currPage = 0;
	if (get_query_var('paged')>1){
		$currPage = $atts['num'] * ($currPage-1);
		$args['types_purpose'] = $cats;
	}

	$numPosts = (int)$atts['num'];
	if ($numPosts>=$postAll)
		$numPosts = $postAll;

	// Подключить пост если ничего не найдено
	if ($cats && $postAll == 0){
		$wp_query = new WP_Query([
			'post_type' => $atts['post_type'],
			'types_purpose' => 'no',
		]);
	}
	$out = '<div class="post-grid '.$atts['view'].' row">';
	$view= 'view-' . $_GET['view'];
	if (!file_exists(AXSHORTCODES . 'tamplate/'. $atts['view'] . '/' .$view.'.php')){
		$view = '';
	}

	ob_start();
	while ( $wp_query->have_posts() ){
		$wp_query->the_post();

		if ($postAll>0){

			// Вид списком или плитками
			if ($view){
				require  (AXSHORTCODES . 'tamplate/'. $atts['view'] . '/'. $view .'.php');
			} else{
				// Вид по умолчанию
				require  (AXSHORTCODES . 'tamplate'.DIRECTORY_SEPARATOR. $atts['view'] . '.php');
			}

		} else{
			// no content
			require  (AXSHORTCODES . 'tamplate/'. $atts['view'] . '/no-content.php');
		}

		$count ++;
	}

	$out .= ob_get_clean();
	$out .= '</div>';

	/*
	 * Pagination
	 * */
	if ($atts['is_nav']>0){
		ob_start();
		the_posts_pagination();
		$out .= ob_get_clean();
	}
	wp_reset_query();
	return $out;
}
add_shortcode( 'ax_post_grid' , 'ax_post_grid' );


function dinamic_load_posts_grid()
{
	$args_js = unserialize(stripslashes($_POST['args']));
	$args_js['offset'] = $_POST['offset'];
	$args_js['numberposts'] = $_POST['numberposts'];

	global $post;
	$posts = get_posts($args_js);

	//error_log( print_r($posts, 1) );
	// если посты есть

	if( !(count($posts) > 0) )
		return;

	foreach( $posts as $post ){ setup_postdata($post);
		require  (AXSHORTCODES . 'tamplate'.DIRECTORY_SEPARATOR.'tmp-grid-title-bottom.php');

	}
	wp_reset_postdata();

	die();
}


add_action('wp_ajax_loadmore', 'dinamic_load_posts_grid');
add_action('wp_ajax_nopriv_loadmore', 'dinamic_load_posts_grid');
?>