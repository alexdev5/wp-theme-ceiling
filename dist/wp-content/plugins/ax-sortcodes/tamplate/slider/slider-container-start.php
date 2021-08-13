<div class="<?= $atts['view'] . ' ' .$atts['post_type'] .' '. $classes?>">
	<!-- Slider main container -->
    <? //var_dump_pre($settings, 1); ?>
	<div class="swiper-container" data-settings='<?= json_encode($settings) ?>'>
		<!-- Additional required wrapper -->

        <? if (userIsAdmin()) echo $editButton; ?>
		<div class="swiper-wrapper">