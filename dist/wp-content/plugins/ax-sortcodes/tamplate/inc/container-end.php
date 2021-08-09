<?
// Для слайдера
if ($atts['view']=='portfolio-slider') {
	echo view('slider/slider-container-end');
} else{
	echo '</div>';
}