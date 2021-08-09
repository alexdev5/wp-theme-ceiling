<div class="ax-pg-title-down ax-pg-<?php echo $atts['col'] ?>">

	<?php
	$args = [
		'height'=>300,
        'crop '=>false,
		//'post_id  '=>get_the_ID(),
	];

	 ?>

	<div class="wp-block-column__children">

		<div class="symptoms-women__img" style="background-image:url('<?php echo kama_thumb_src($args,  get_the_post_thumbnail_url()) ?>');">
		</div>

		<div class="wp-block-buttons">
			<p><?php the_title() ?></p>

			<div class="wp-block-button">
				<a class="wp-block-button__link no-border-radius" href="<?php the_permalink(); ?> "><?php echo $atts['btn_text'] ?></a>
			</div>
		</div>
	</div>
</div>