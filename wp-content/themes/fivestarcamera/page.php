<?php
/**
 * The template for displaying all pages.
 */

global $post;

get_header();


$page_title = '';

if ($post->post_parent) {
	$page_title = get_the_title($post->post_parent);
} else {
	$page_title = get_the_title($post->ID);
}

?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents">

				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1"><?php echo esc_html($page_title); ?></h1>

				<div class="contents-box">

<?php
if ($post->post_parent) {
	$parent = get_post($post->post_parent);
	if ($parent->post_name === 'guide') {
		get_template_part('menu-guide');
	}
} else {
	if ($post->post_name === 'guide') {
		get_template_part('menu-guide');
	}
}

while ( have_posts() ) : the_post();

	the_content();

endwhile;

if ($post->post_parent) {
	$parent = get_post($post->post_parent);
	if ($parent->post_name === 'guide') {
		get_template_part('menu-guide');
	}
} else {
	if ($post->post_name === 'guide') {
		get_template_part('menu-guide');
	}
}
?>

				</div>

			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php
get_footer();
