<div class="post-grid-item col col-12 col-md-6 col-lg-<?php echo $atts['col'] ?> post-grid-last" >

   <!-- mobile -->
   <div class="md-block">
      <a href="<?php echo $atts['our_work_link'] ?>" class="button btn-green w-100">
         <?php echo valueIf(ICL_LANGUAGE_CODE=='uk', 'Дивитись всі', "Смотреть все")?>
      </a>
   </div>

   <!-- PC -->
	<div class="relative lg-block">
		<div class="hover-block--btns">
			<a class="block-last show-more" href="#">
              <span>
                  <?php echo $atts['more_text'] ?>
              </span>
			</a>
			<a class="block-last show-less hidden" href="#">
              <span>
                  <?php echo $atts['less_text'] ?>
              </span>
			</a>
		</div>
      <img src="<?php echo kama_thumb_src($args,  get_the_post_thumbnail_url()) ?>" alt="">
	</div>
</div>
