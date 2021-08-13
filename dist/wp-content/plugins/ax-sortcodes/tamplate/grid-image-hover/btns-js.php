<div class="post-grid-item col col-12 col-md-6 col-lg-<?php echo $atts['col'] ?> post-grid-last" >

	<? if ($last<=0): ?>
		<div class="md-block">
			<a href="<?php echo $atts['our_work_link'] ?>" class="button btn-green w-100">
				<?php echo valueIf(ICL_LANGUAGE_CODE=='uk', 'Дивитись всі', "Смотреть все")?>
			</a>
		</div>
	<? endif; ?>

	<div class="relative">
		<div class="hover-block--btns">
			<a class="block-last show-more" href="#">
                    <span>
                        <?php echo $atts['more_text'] ?>
                    </span>
			</a>
			<a class="block-last show-less" href="#">
                    <span>
                        <?php echo $atts['less_text'] ?>
                    </span>
			</a>
		</div>

		<!-- Video -->
		<? if (get_field('url_video_background') || get_field('url_video_background_media') && !axCheckOption('video_background_disabled')): ?>
			<div class="post-grid--video" id="video-bg-<?= get_the_ID() ?>">
				<div id="video-back">
					<video preload="auto" poster="<?php echo kama_thumb_src($args,  get_the_post_thumbnail_url()) ?>" autoplay muted loop class="vidbacking">
						<source src="<?= get_field('url_video_background') ?>" type="video/mp4">
					</video>
				</div>
			</div>
			<!-- video -->

		<? else: ?>
			<img src="<?php echo kama_thumb_src($args,  get_the_post_thumbnail_url()) ?>" alt="">
		<? endif;?>


		<? if ($last>0): ?>
			<div class="item-title">
				<div class="item-title--left">
                        <span class="the-title md-block">
                          <? the_title() ?>
                        </span>
					<span class="post-item__price">
                            <?php echo get_field('price_ceiling') ?>
                        </span>
				</div>
				<span><?php the_title() ?></span>
				<button class="button btn-green btn-order md-block">
					<?php echo $atts['btn_text'] ?>
				</button>
			</div>
		<? endif; ?>
	</div>

</div>
