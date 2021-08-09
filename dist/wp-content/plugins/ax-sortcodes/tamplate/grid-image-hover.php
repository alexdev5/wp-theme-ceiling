<?php $args = [
	'width'=>428,
	'height'=>300,
	'crop '=>true,
	'post_id  '=>get_the_ID(),
];

$last = 1;
if ($atts['isnt_last']){
	$last = (int)$atts['num'] - $count;
}
?>

<div class="post-grid-item col col-12 col-md-6 col-lg-<?php echo $atts['col'] ?> <?= valueIf($last>0, '', 'post-grid-last') ?>" >

	<? if ($last<=0): ?>
        <div class="md-block">
            <a href="<?php echo $atts['our_work_link'] ?>" class="button btn-green w-100">
              <?php echo valueIf(ICL_LANGUAGE_CODE=='uk', 'Дивитись всі', "Смотреть все")?>
            </a>
        </div>
    <? endif; ?>

	<div class="relative">

        <? if ($last>0): ?>
            <div class="hover-block">
                <span class="post-grid__title-2">
                  <?php the_title() ?>
                </span>
                <span class="post-item__price">
                    <?php echo get_field('price_ceiling') ?>
                </span>
                <a href="<?php echo $atts['our_work_link'] ?>">
                  <?php echo $atts['our_work_link_text'] ?>
                </a>
                <button class="button btn-green btn-order">
                  <?php echo $atts['btn_text'] ?>
                </button>
            </div>
        <? else: ?>
            <a class="block-last" href="<?php echo $atts['our_work_link'] ?>">
                <span>
                    <?php echo $atts['last_link_text'] ?>
                </span>
            </a>
        <? endif; ?>

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
