<?
/*$dataFilter = [];

foreach ($terms as $key=>$term){
	$dataFilter[] = [
		'id'=>$term->term_id,
		'slug'=>$term->slug,
		'name'=>$term->name,
		'count'=>$term->count,
	];
}*/

?>

<div class="type-filter <?= $atts['classes'] ?>" >
    <label class="checkbox">
        <input type="checkbox" class="all" data-link="/ceilings/">
        <b><svg viewBox="0,0,50,50">
                <path d="M5 30 L 20 45 L 45 5"></path>
            </svg></b>
        <span><?= valueIf(ICL_LANGUAGE_CODE=='uk', 'Всі', "Все") ?></span>
    </label>

    <? foreach ($terms as $key=>$term):?>
        <label class="checkbox">
            <input type="checkbox" name="<?= $term->slug ?>" value="<?= $term->term_id ?>" data-count="<?= $term->count ?>">
            <b><svg viewBox="0,0,50,50">
                    <path d="M5 30 L 20 45 L 45 5"></path>
                </svg></b>
            <span><?= $term->name ?></span>
         </label>
    <? endforeach; ?>
</div>