<?

if ($atts['view']=='portfolio-slider'){
	echo view('slider/slider-container-start', [
		'atts'=>$atts, 'settings'=>$settings]
	);
}
elseif($atts['view']=='blog'){
	echo '<div class="blog-grid row">';
}
else{
	echo '<div class="portfolio-grid row">';
}

?>