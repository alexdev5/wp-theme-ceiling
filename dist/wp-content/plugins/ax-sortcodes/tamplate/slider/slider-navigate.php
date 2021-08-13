<!-- If we need pagination -->
<div class="swiper-pagination"></div>

<!-- If we need navigation buttons -->

<? if ($data['btn_alt']): ?>
   <div class="axslider-button axslider-button--alt ">
      <div class="axslider-button--prev">
         <img src="<?= AX_IMG_DIR . 'arrow-left-alt.svg' ?>" alt="">
      </div>
      <div class="axslider-button--next">
         <img src="<?= AX_IMG_DIR . 'arrow-right-alt.svg' ?>" alt="">
      </div>
   </div>
<? else: ?>
   <div class="axslider-button">
      <div class="axslider-button--prev">
         <img src="<?= AX_IMG_DIR . 'arrow-left.svg' ?>" alt="">
      </div>
      <div class="axslider-button--next">
         <img src="<?= AX_IMG_DIR . 'arrow-right.svg' ?>" alt="">
      </div>
   </div>
<? endif; ?>
<!-- If we need scrollbar -->
<!--<div class="swiper-scrollbar"></div>-->