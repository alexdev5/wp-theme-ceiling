<?php 
$id = get_the_ID();
$args = [
	'width'=>657,
	'height'=>400,
	'crop '=>true,
	'post_id  '=>$id,
];

$last = 0;
if ($atts['isnt_last']){

    $passedPosts = $wp_query->current_post+1 + $currPage;
	$last = $postAll - $passedPosts;
}


$priceString = get_field('price_ceiling', $id);
$priceFormat = preg_replace('/(\D+)(\d+)(.+)/im', '$1 <b>$2</b> $3', $priceString);
?>

<div class="post-grid-item col col-12 col-md-6 grid-image">

	<a href="<?= get_the_permalink() ?>" class="relative item-permalink">

        <img src="<?php echo kama_thumb_src($args,  get_the_post_thumbnail_url()) ?>" alt="">

         <div class="block-bottom">
                <div class="item-top">
                    <div class="item-top__left">
                        <span class="the-title md-block">
                          <? the_title() ?>
                        </span>
                         <span class="post-item__price">
                            <?php echo $priceFormat ?>
                        </span>
                    </div>

                    <div class="item-top__right item-info">
                        <span class="ds-block">
                             <?php echo get_field('completed_works_text', $id) ?>
                        </span>
                        <span class="ds-block h4">
                             <?php echo get_field('completed_works_num',$id) ?>
                        </span>
                    </div>
                </div>

                <div class="item-title">
                    <span><?php the_title() ?></span>
                    <button class="button btn-green btn-order md-block">
                            <?php echo $atts['btn_text'] ?>
                    </button>
                </div>
            </div>

	</a>
</div>