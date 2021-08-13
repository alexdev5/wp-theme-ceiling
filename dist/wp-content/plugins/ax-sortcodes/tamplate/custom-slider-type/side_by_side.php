<?
// Изображение (слева) и текст(справа)
// находятся на одном уровне
// 580*540
		/**
			*$slide - foreach in custom-slider.php
		 */
$argsImg = [
	'width'=>607,
	'height'=>540,
	'crop '=>'bottom',
	'src  '=>$imgUrl,
];
// sizes="(max-width: 670px) 100vw, 670px
?>
<? if ($imgUrl): ?>

	<div class="wp-block-media-text alignwide is-stacked-on-mobile">
		<figure class="wp-block-media-text__media">
			<img  width="<?= $argsImg['width'] ?>" height="<?= $argsImg['height'] ?>" src="" data-src="<?=kama_thumb_src($argsImg, $imgUrl) ?>" class="swiper-lazy" alt="" data-src-mobile="<?=$imgUrl ?>">
			<div class="swiper-lazy-preloader"></div>
		</figure>
		<div class="wp-block-media-text__content">
			<? echo $slide['slide_text']; ?>
		</div>
	</div>

<? elseif($slide['slide_video']): ?>

	<div class="wp-block-media-text alignwide is-stacked-on-mobile">
		<div>
			<? echo $slide['slide_video'] ?>
			<div class="media-header">
				<? echo $slide['slide_header'] ?>
			</div>
		</div>
		<div class="wp-block-media-text__content">
			<? echo $slide['slide_text']; ?>
		</div>
	</div>

<? endif; ?>
