<?php
/**
 * The template for displaying all pages.
 */

get_header();
?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents">

				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1">お知らせ</h1>

				<div class="contents-box">

					<section id="info" class="column">

<?php
	while ( have_posts() ) : the_post();
?>
	<div class="entry">
		<h2 class="ttlLev3"><?php the_title(); ?></h2>
		<div class="date"><?php the_time("Y.n.j"); ?></div>
		<?php the_content(); ?>
	</div>

<?php
	endwhile;
	if (function_exists('wp_pagenavi')) {wp_pagenavi();}
?>

					</section>
				</div>

			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php
get_footer();
