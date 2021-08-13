<?
// Меняются только изображения, текст не меняется
// ?>


<? if ($imgUrl): ?>
	<img data-src="<?=$imgUrl ?>" class="swiper-lazy" alt="" data-src-mobile="<?=$imgUrl ?>" width="<?= $imgWidth ?>" height="<?= $imgHeight ?>">
	<div class="swiper-lazy-preloader"></div>
<? elseif($slide['slide_video']): ?>
	<? echo $slide['slide_video'] ?>
	<div class="media-header">
		<? echo $slide['slide_header'] ?>
	</div>
<? endif; ?>

