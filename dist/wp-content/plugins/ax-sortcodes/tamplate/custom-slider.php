<? // shortcode: custom-slider.php [axslider id = <id>] ?>

<?
$sliderData = get_field('custom_slider', (int)get_the_ID());
$disableMobile = get_field('disable_mobile')[0];



//print_r(get_fields(get_the_ID(), 'array'));
//var_dump($sliderData);
?>

<? //var_dump_pre($slideView, 1); ?>

<? foreach ($sliderData as $key=>$slide): ?>
   <div class="swiper-slide" data-swiper-autoplay="2000">
       <?
       $imgUrl = $slide['slide_image']['url'];
       $imgWidth = $slide['slide_image']['width'];
       $imgHeight = $slide['slide_image']['height'];

       $typeSlider = get_field('type_slider');

       /** Types:
         *  side_by_side
         *  change_img_only
         *  default
         */
      $file =  AXSHORTCODES . 'tamplate/custom-slider-type/'.$typeSlider.'.php';

      if(file_exists($file)){
         require $file;
      } else{
         require AXSHORTCODES . 'tamplate/custom-slider-type/default.php';;
      } ?>
   </div>
<?endforeach; ?>