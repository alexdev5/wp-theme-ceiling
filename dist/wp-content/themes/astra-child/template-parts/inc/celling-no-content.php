<!-- 656x400 -->
<?
$args_img = [
	'width'=>657,
	'height'=>400,
	'crop '=>true,
	'post_id  '=>get_the_ID(),
];
?>
<div class="post-grid grid-image row celling-no-result">
	<div class="post-grid-item col col-12 col-md-6 grid-image" >

		<a href="#" class="relative item-permalink" onclick="return false" >
			<div class="block-last">
                 <span class="h3">
                    <?php the_title() ?>
                </span>
				<span class="last-item-content">
                     <?php the_content(); ?>
                </span>
				<button class="button btn-green btn-order">
					<?php echo get_field('btn_text'); ?>
				</button>
			</div>
         <?= kama_thumb_img($args_img) ?>
		</a>

	</div>
</div>
