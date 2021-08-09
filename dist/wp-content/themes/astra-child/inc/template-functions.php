<?
function makee_body_classes( $classes ) {
	$class_page = get_field('add_class_page');
	if($class_page) {
		$classes[] = $class_page;
	}

	if( ICL_LANGUAGE_CODE && ICL_LANGUAGE_CODE!='' ){
		$classes[] = 'locale-site-' . ICL_LANGUAGE_CODE;
	}
	return $classes;
}
add_filter( 'body_class', 'makee_body_classes' );

function axCheckOption($check){
	return in_array($check, axGetOption('option_check'));
}