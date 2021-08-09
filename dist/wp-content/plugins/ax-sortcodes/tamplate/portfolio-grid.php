<?php $args = [
	'width'=>635,
	'height'=>400,
	'crop '=>true,
	'post_id  '=>get_the_ID(),
];

//$result = array();
// с помощью регулярного выражения из $item->introtext мы получаем массив путей $result
preg_match_all('/<!-- wp:gallery ([^}]+})/im', get_the_content(), $result);

$gallery = '';
if ($result[1]){
	$gallery = json_decode($result[1][0]);
}
$imgs = [];

foreach ($gallery->ids as $key=>$id){
   $imgs[] = kama_thumb_src([
		 'width'=>280,
		 'height'=>280,
		 'attach_id'=>$id,
		 'src '=>wp_get_attachment_image_src($id, 'full')[0],
	 ]);
}

?>
<? //print_r_pre($imgs) ?>

<div class="col col-12 col-sm-<?php echo $atts['col'] ?>" data-slider='<?= json_encode($imgs) ?>'>

   <div class="row portfolio-item">
      <div class="col-12 col-sm-6 portfolio-item--text">
         <div class="portfolio-item--title h4">
             <?php the_title() ?>
         </div>
         <div class="portfolio-item--preview">
            <?php echo kama_excerpt() ?>
         </div>

         <a href="<? the_permalink() ?>" class="button btn-border">
					 <?php echo $atts['btn_text'] ?>
         </a>
      </div>

      <div class="col-12 col-sm-6 portfolio-item--image">
         <div class="thumbnail-img">
            <img src="<?php echo kama_thumb_src($args,  get_the_post_thumbnail_url()) ?>" alt="">
         </div>
      </div>
   </div>

</div>
