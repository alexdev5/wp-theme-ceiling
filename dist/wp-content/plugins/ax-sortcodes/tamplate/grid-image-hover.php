<?php $args = [
	'width'=>428,
	'height'=>300,
	'crop '=>true,
	'post_id  '=>get_the_ID(),
];

$last = 1;

if ($atts['more_btns']){
	$last = $numPosts - $count;
}

?>

<div class="post-grid-item col col-12 col-md-6 col-lg-<?= $atts['col'] ?> <?= valueIf($atts['per_view'] < $count, 'post-grid--hidden post-grid--more') ?>" >

	<div class="relative">
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
				<?php echo kama_thumb_img($args,  get_the_post_thumbnail_url()) ?>
      <? endif;?>


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
	</div>

</div>

<? if ($last<=0){
	require  (AXSHORTCODES . 'tamplate/grid-image-hover/btns-js.php');
}?>
