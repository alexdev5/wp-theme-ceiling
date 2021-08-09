
<? if ($_count==1): ?>

  <?php $imgData = [
	'width'=>620,
	'height'=>380,
	'crop'=>true,
	'post_id'=>get_the_ID(),
]; ?>
   <div class="row blog-grid--first">
      <div class="col-12 col-md-6 first-img">
         <a class="" href="<?= get_the_permalink() ?>">
            <img src="<?php echo kama_thumb_src($imgData,  get_the_post_thumbnail_url()) ?>" alt="">
         </a>
      </div>
      <div class="col-12 col-md-6">
         <div>
            <p class="date">
                   <? the_time('j F Y') ?>
            </p>
            <h4><? the_title() ?></h4>
            <p><?= kama_excerpt(['maxchar'=>1000]) ?></p>
         </div>
      </div>
   </div>

<? else: ?>
	<?php $imgData = [
		'width'=>400,
		'height'=>240,
		'crop '=>true,
		'post_id  '=>get_the_ID(),
	]; ?>

   <div class="col-12 col-lg-4 col-sm-6 blog-grid--item">
      <div class="item">

         <div class="item-img">
            <a href="<?= get_the_permalink() ?>">
               <img src="<?php echo kama_thumb_src($imgData,  get_the_post_thumbnail_url()) ?>" alt="">
            </a>
         </div>

         <div class="item-text">
            <p class="date">
							<? the_time('j F Y') ?>
            </p>
            <h4><? the_title() ?></h4>
            <p><?= kama_excerpt(['maxchar'=>150]) ?></p>
         </div>
      </div>
   </div>
<? endif; ?>


<!--<div class="modal fade modal-callback" id="modal-call" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title mb-0">Укажите ваше имя и номер</h3>
            <p>и мы свяжемся с вами для оформления заказа</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form class="form">
               <div class="mb-3">
                  [text* your-name placeholder "Ваше имя"]
               </div>
               <div class="mb-3">
                  [tel* tel-564 placeholder "Номер телефона"]
               </div>
               <div class="mb-3">
                  [tel* tel-564 placeholder "Номер телефона"]
                  <small>не обязательное поле</small>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary">Understood</button>
         </div>
      </div>
   </div>
</div>-->



