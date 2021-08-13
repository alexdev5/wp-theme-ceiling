
<?
$_args = [
	'width' => $atts['slides_per_view']=='auto' ? 873: 1320,
	'height' => (int)$atts['height']>0 ? (int)$atts['height']:373,
	'crop ' => true,
	'post_id  ' => get_the_ID(),
];


$argsMobile = [
	'width' => 280,
	'height' => 280,
	'crop ' => true,
	'post_id  ' => get_the_ID(),
];


// text_alt_header
// text_date_sale
// text_sale

?>
<!-- Slides -->
<div class="swiper-slide swiper-slide<?= valueIf($atts['slides_per_view'], '-'.$atts['slides_per_view']) ?>">
    <img data-src="<?php echo kama_thumb_src($_args,  get_the_post_thumbnail_url()) ?>" data-src-mobile="<?php echo kama_thumb_src($argsMobile,  get_the_post_thumbnail_url()) ?>" alt="" class="swiper-lazy" width="<?= $_args['width'] ?>" height="<?= $_args['height'] ?>">
   <div class="swiper-lazy-preloader"></div>

    <div class="slide-content">
       <? if($atts['post_type'] === 'portfolio'): ?>
          <h4 class="slide-content--header">
             <span class="d-flex jc-between ai-end">
                <span><?= valueIf(get_field('text_alt_header'), get_field('text_alt_header'), the_title()) ?></span>
                <a href="/portfolio">
                  <?= axGetOption('text_gallery') ?>
                </a>
             </span>

          </h4>
          <div class="slide-content--text">
               <?= kama_excerpt(['maxchar'=>100]) ?>
          </div>
           <div class="slide-content--button sm-block">
               <a href="<?= get_the_permalink() ?>" class="button btn-border">
                   <?= $atts['btn_text'] ?>
               </a>
           </div>

       <? else: ?>
          <div class="slide-content--header">
            <?= valueIf(get_field('text_alt_header'), get_field('text_alt_header'), the_title()) ?>
          </div>
          <h4 class="slide-content--sale">
               <?= get_field('text_sale') ?>
          </h4>
          <div class="slide-content--date">
               <?= get_field('text_date_sale') ?>
          </div>
       <? endif; ?>
    </div>
</div>

