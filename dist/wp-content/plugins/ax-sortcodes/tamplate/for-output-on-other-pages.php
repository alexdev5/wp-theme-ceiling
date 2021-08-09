<?php
/* Template Name: Вывод на других страницах
 Template post type: post, page
*/
?>

<?php

global $cl_redata, $cl_current_view;
$cl_current_view = 'single_blog';
$spancontent = 12;

$layout = $cl_redata['singlebloglayout'];

if($cl_redata['overwrite_layout'])
	$layout = $cl_redata['layout'];

if($layout == 'fullwidth')
	$spancontent = 12;
else if($layout == 'dual')
	$spancontent = 6;
else
	$spancontent = 9;


$blog_page = $cl_redata['blogpage'];

get_header();

?>

<?php get_template_part('includes/view/page_header'); ?>
<?php if(!$cl_redata['fullscreen_post_style']): ?>
<section id="content" class="<?php echo esc_attr($layout) ?>"  style="background-color:<?php echo (!empty($cl_redata['page_content_background']))?esc_attr($cl_redata['page_content_background']):'#ffffff'; ?>;">

    <div class="container <?php  echo esc_attr($layout) ?>" id="blog">
        

		<?php the_content(); ?>


	</div>

</section>
<?php endif; ?>
<?php if($cl_redata['fullscreen_post_style']): ?>
	<?php get_template_part('includes/view/blog/single', 'fullscreen'); ?>
<?php endif; ?>

<?php get_footer(); ?>

