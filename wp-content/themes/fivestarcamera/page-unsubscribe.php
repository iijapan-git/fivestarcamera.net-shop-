<?php
/**
 * The template for displaying all pages.
 */

if (!is_user_logged_in()) {
	header('Location: '. esc_url(home_url())) ;
}

get_header();
?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents">

				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1"><?php the_title(); ?></h1>

				<div class="contents-box">

<?php
	while (have_posts()) : the_post();

		the_content();

	endwhile;
?>

				</div>

			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php
get_footer();
