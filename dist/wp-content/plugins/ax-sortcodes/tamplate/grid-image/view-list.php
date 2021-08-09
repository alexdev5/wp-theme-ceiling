<?php $args = [
	'width'=>657,
	'height'=>400,
	'crop '=>true,
	'post_id  '=>get_the_ID(),
];

$priceString = get_field('price_ceiling');
$priceFormat = preg_replace('/(\D+)(\d+)(.+)/im', '$1 <b>$2</b> $3', $priceString);
?>

<div class="post-grid-item view-list col col-12 col-lg-<?php echo $atts['col'] . ' '. $atts['view'] ?>" >

	<div class="row">
        <div class="col-6 view-list--text">
            <a href="<? the_permalink() ?>" class="h4"><?php the_title() ?></a>
            <span><?= $priceFormat ?></span>
        </div>
        <div class="col-6 view-list--button">
            <button class="button btn-green btn-order">
				<?php echo $atts['btn_text'] ?>
            </button>
        </div>
	</div>

    <?php /*echo get_field('completed_works_text') */?><!--
    --><?php /*echo get_field('completed_works_num') */?>

</div>
