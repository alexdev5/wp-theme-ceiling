<?

function makee_ajax_posts(){
	if( empty($_POST['nonce']) )
		wp_die();
	$nonce_outside = $_POST['nonce'];
	$nonce_inside = wp_create_nonce('makee-script');
	if($nonce_outside !== $nonce_inside){
		echo 'Not';
		wp_die('','','403');
	}
	global $post;
	echo json_encode($_POST);

	// Потом можно сделать extract
	$tax_type = '';
	$tax_area = '';
	$tax_interior = '';
	$post_offset = 0;
	$posts_per_page = 10;
	$curr = isset($_POST['curr'])?strtolower($_POST['curr']):'';

	// тип недвижимости
	if(isset($_POST['type_property']) && $_POST['type_property']){
		$tax_type = implode(',', $_POST['type_property']);
	}

	/*$args = [
		//'posts_per_page'=> $posts_per_page,
		'posts_per_page'=> 10000, // если указать -1, не работае "offset"
		// отсчет начинается с первого числа не зависимо что указано в "offset"
		'post_type' => 'real_property',
		'type_property' => $tax_type,
		'areas_on_the_ground' => $tax_area,
		'interior_decoration' => $tax_interior,
		'selection_property' => $tax_select_property,
		'meta_query' => $meta_fields,
		'offset' => $post_offset,
		'post_status'=> 'publish',
	];*/


	//$query = new WP_Query($args);


	//echo json_encode($res);
	wp_reset_postdata();
	wp_die();
}

add_action('wp_ajax_makee_ajax_posts', 'makee_ajax_posts');
add_action('wp_ajax_nopriv_makee_ajax_posts', 'makee_ajax_posts');