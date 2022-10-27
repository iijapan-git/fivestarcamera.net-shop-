<?php
/**
 * The template for displaying product content in the single-product.php template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
?>

	<div class="title-block">
		<div class="date en"><?php echo the_time('Y.n.j'); ?></div>
		<h1 class="title"><?php the_title(); ?></h1>
	</div>
	<div class="tag-block">

<?php
$categories = get_the_category();
if ($categories) :
?>
		<div class="categories">

<?php
	foreach ($categories as $cat) :
?>

			<div class="cat"><?php echo $cat->name?></div>

<?php
	endforeach;
?>

		</div>
<?php
endif;
?>
		<div class="sheres">
			<div class="shere-label"><img src="<?php echo esc_url(home_url()); ?>/common/images/special/lb_shere.gif"></div>
			<div class="shere-button"><?php if(function_exists("get_my_sns_buttons")){echo get_my_sns_buttons();}?></div>
		</div>
	</div>

	<div class="body"><?php the_content(); ?></div>

	<div class="sheres">
		<div class="shere-label"><img src="<?php echo esc_url(home_url()); ?>/common/images/special/lb_shere.gif"></div>
		<div class="shere-button"><?php if(function_exists("get_my_sns_buttons")){echo get_my_sns_buttons();}?></div>
	</div>

	<div class="link-block">

<?php
	$prev_post = get_previous_post();
	if (!empty($prev_post)) :
?>

		<div class="link-prev">
			<a href="<?php echo get_permalink($prev_post->ID); ?>">
				<p>前の記事<br><?php echo get_the_title($prev_post->ID); ?></p>
			</a>
		</div>
<?php
	endif;

	$next_post = get_next_post();
	if (!empty($next_post)) :
?>
		<div class="link-next">
			<a href="<?php echo get_permalink($next_post->ID); ?>">
				<p>次の記事<br><?php echo get_the_title($next_post->ID); ?></p>
			</a>
		</div>
<?php
	endif;
?>
	</div>

