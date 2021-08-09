<?

function my_post_count_queries( $query ) {


}
add_action( 'pre_get_posts', 'my_post_count_queries' );