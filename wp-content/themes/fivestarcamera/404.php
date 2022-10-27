<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package storefront
 */

get_header(); ?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents">

				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1"><?php the_title(); ?></h1>

				<div class="contents-box">

					<p>ご指定のページが見つかりません。</p>

					<div class="btn-box"><a href="<?php echo esc_url(home_url()); ?>"><span>トップへ戻る</span></a></div>

				</div>

			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php get_footer();
