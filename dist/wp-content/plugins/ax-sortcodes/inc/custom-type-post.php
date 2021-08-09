<?php
function custom_taxonomies_view(){

	// По назначению
	register_taxonomy( 'types_purpose', ['ceilings'], [
		'label' => '', // определяется параметром
		'labels'              => [
			'name'              => 'Категория',
			'singular_name'     => 'Категория',
			'search_items'      => 'Найти',
			'all_items'         => 'Все',
			'view_item '        => 'Открыть список',
			'parent_item'       => 'Родительская категория',
			'parent_item_colon' => 'Родительская категория:',
			'edit_item'         => 'Редактировать',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить новый',
			'new_item_name'     => 'Имя',
			'menu_name'         => 'Категории',
		],
		'public'                => true,
		'hierarchical'          => true,
		"has_archive" => true,
		'rewrite'               => [
			'slug'=>'type-ceilings',
			'hierarchical'=>true
		],
		'capabilities'          => array(),
		'show_in_rest' => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
	] );



}

add_action( 'init', 'custom_taxonomies_view');

function custom_post_type(){
	// Виды потолков
	register_post_type( "ceilings", [
		"labels" => [
			"name" => "Виды потолков",
			"singular_name" => 'Вид потолка',
			'all_items'         => 'Все записи',
			'add_new'            => 'Добавить запись',
			'edit_item'          => 'Редактировать запись',
			'new_item'           => 'Новый вид',
			'view_item'          => 'Посмотреть вид',
			'search_items'       => 'Найти вид',
			'not_found'          => 'Не найдено видов',
			'menu_name'          => 'Виды потолков',
			'featured_image'     => 'Изображение записи',
			'set_featured_image' => 'Установить изображение',
			'remove_featured_image' => 'Удалить изображение',
			'filter_items_list' => 'Фильтровать список записей',
		],
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		//"rest_base" => "",
		//"rest_controller_class" => "WP_REST_Posts_Controller",
		"menu_position" => 20,
		"menu_icon" => 'dashicons-admin-multisite',
		"map_meta_cap" => true,
		"has_archive" => true,
		//'taxonomies' => array( 'type_property' ),
		"rewrite" => [
			"slug" => "ceiling",
			'with_front' => true
		],
		"exclude_from_search" => false,
		"hierarchical" => false,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "page-attributes", "post-formats" ],
	] );

	// Порфолио
	register_post_type( "portfolio", [
		"labels" => [
			"name" => "Портфолио",
			"singular_name" => 'Портфолио',
			'all_items'         => 'Все записи',
			'add_new'            => 'Добавить запись',
			'edit_item'          => 'Редактировать запись',
			'new_item'           => 'Создать',
			'view_item'          => 'Посмотреть',
			'search_items'       => 'Найти вид',
			'not_found'          => 'Не найдено видов',
			'menu_name'          => 'Портфолио',
			'featured_image'     => 'Изображение записи',
			'set_featured_image' => 'Установить изображение',
			'remove_featured_image' => 'Удалить изображение',
			'filter_items_list' => 'Фильтровать список записей',
		],
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		//"rest_base" => "",
		//"rest_controller_class" => "WP_REST_Posts_Controller",
		"menu_position" => 21,
		"menu_icon" => 'dashicons-media-document',
		"map_meta_cap" => true,
		"has_archive" => false,
		//'taxonomies' => array( 'type_property' ),
		"rewrite" => [ "slug" => "works" ],
		"exclude_from_search" => false,
		"hierarchical" => false,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "page-attributes", "post-formats" ],
	] );

	// Порфолио
	register_post_type( "sliders", [
		"labels" => [
			"name" => "Слайдер",
			"singular_name" => 'Слайдер',
			'all_items'         => 'Все слайдеры',
			'add_new'            => 'Добавить',
			'edit_item'          => 'Редактировать',
			'new_item'           => 'Создать',
			'view_item'          => 'Посмотреть',
			'search_items'       => 'Найти вид',
			'not_found'          => 'Не найдено видов',
			'menu_name'          => 'Слайдеры',
			'featured_image'     => 'Изображение записи',
			'set_featured_image' => 'Установить изображение',
			'remove_featured_image' => 'Удалить изображение',
			'filter_items_list' => 'Фильтровать список записей',
		],
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		//"rest_base" => "",
		//"rest_controller_class" => "WP_REST_Posts_Controller",
		"menu_position" => 21,
		"menu_icon" => 'dashicons-images-alt2',
		"map_meta_cap" => true,
		"has_archive" => false,
		//'taxonomies' => array( 'type_property' ),
		"rewrite" => [ "slug" => "sliders" ],
		"exclude_from_search" => false,
		"hierarchical" => false,
		"supports" => [ "title", "thumbnail", "custom-fields" ],
	] );
}
add_action( 'init', 'custom_post_type');

///
///


/**
 * Добавить поле шорткода в тип поста "Slider"
 */
add_filter( 'manage_posts_columns', 'ax_set_new_columns', 10, 2 );
function ax_set_new_columns( $columns, $post_type ){
	if ('sliders' === $post_type){
		$newColumn['shortcode'] = 'Шотркод';
		 $columns =  array_slice( $columns, 0, 2 ) + $newColumn + $columns;
	}
	return $columns;
}

// Выводим контент для каждого из своих столбцов. Обязательно.
add_action( 'manage_sliders_posts_custom_column', function ( $column_name, $postID ) {
	if ( $column_name === 'shortcode') {
		echo "<span class='slider-shortcode'>[axslider id=$postID info=\"".get_the_title()."\"]</span>";
	}
}, 10, 2 );

// Выводим стили для своих столбцов. Необязательно.
add_action( 'admin_print_footer_scripts-edit.php', function () {
	?>
	<style>
		.slider-shortcode {
			background: #fff;
			border: 1px solid #C3C4C7;
			padding: 5px 10px;
			border-radius: 5px;
			display: inline-block;
		}
	</style>
	<?php
} );