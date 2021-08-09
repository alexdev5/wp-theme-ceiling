<? // shortcode: custom-slider.php [axslider id = <id>] ?>

<?
$sliderData = get_field('custom_slider');
$disableMobile = get_field('disable_mobile')[0];



//print_r(get_fields(get_the_ID(), 'array'));
//var_dump($sliderData);
?>

<? foreach ($sliderData as $key=>$slide): ?>
   <div class="swiper-slide" data-swiper-autoplay="2000">
       <?
       $imgUrl = $slide['slide_image']['url'];
       $imgWidth = $slide['slide_image']['width'];
       $imgHeight = $slide['slide_image']['height'];
       ?>

       <? if ($imgUrl): ?>

      <img data-src="<?=$imgUrl ?>" class="swiper-lazy" alt="" data-src-mobile="<?=$imgUrl ?>" width="<?= $imgWidth ?>" height="<?= $imgHeight ?>">
          <div class="swiper-lazy-preloader"></div>
      <? elseif($slide['slide_video']): ?>
           <? echo $slide['slide_video'] ?>
           <div class="media-header">
                 <? echo $slide['slide_header'] ?>
           </div>
      <? endif; ?>
       </div>
<? endforeach; ?>