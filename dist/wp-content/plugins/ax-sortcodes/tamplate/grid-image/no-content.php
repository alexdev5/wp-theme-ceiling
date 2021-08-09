<?php $args = [
	'width'=>657,
	'height'=>400,
	'crop '=>true,
	'post_id  '=>get_the_ID(),
];

?>

<div class="post-grid-item post-grid-item-last col col-12 col-sm-<?php echo $atts['col'] . ' '. $atts['view'] ?>" >

	<a href="#" class="relative item-permalink" onclick="return false" >

		<div class="block-last">
                 <span class="h3">
                    <?php the_title() ?>
                </span>
			<span class="last-item-content">
                     <?php the_content(); ?>
                </span>
			<button class="button btn-green btn-order">
				<?php echo $atts['btn_text'] ?>
			</button>
		</div>

		<img src="<?php echo kama_thumb_src($args,  get_the_post_thumbnail_url()) ?>" alt="">
	</a>

</div>
