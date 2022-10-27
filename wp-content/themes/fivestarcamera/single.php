<?php
/**
 * The template for displaying single posts.
 */

get_header();
?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents" class="_main">

				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1">特集・コラム</h1>

				<div class="contents-box">

<?php
	while ( have_posts() ) : the_post();

		get_template_part('special/content');

	endwhile;
?>

				</div>

			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php
get_footer();
