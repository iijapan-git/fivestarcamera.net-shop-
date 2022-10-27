<?php
/**
 * The template for displaying search page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents">

				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1">絞り込み検索</h1>

				<div class="contents-box">

					<?php get_template_part('search-form'); ?>

<?php
	if (have_posts()) :
?>

					<p class="result"><?php echo $wp_query->found_posts; ?> 件の検索結果</p>

					<?php get_template_part('products/sort'); ?>

					<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>

					<section class="products-list column">

<?php
		while (have_posts()) : the_post();
			if (get_post_type() !== 'product') {
				continue;
			}

			get_template_part('products/loop');

		endwhile;
?>

					</section>

					<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>

<?php
	else : 
?>

	商品が見つかりませんでした。

<?php
	endif;
?>
				</div>

			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php
get_footer();
