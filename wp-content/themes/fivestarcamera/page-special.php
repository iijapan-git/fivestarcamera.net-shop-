<?php
/**
 * page-special
 */

	get_header();
?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents">

				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1">特集・コラム</h1>

				<div class="contents-box">
					<p>中古カメラ好きはもちろん、カメラを持っているなら必ず役立つ情報や豆知識をお届けします。</p>

					<?php get_template_part('special/tab'); ?>


					<section id="special-column" class="column">

<?php
	$posts_per_page = get_option('posts_per_page');
	$paged = get_query_var('paged');
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged,
	);
	$news_query = new WP_Query($args);
	if ($news_query->have_posts()) :
		while ($news_query->have_posts()) : $news_query->the_post();

			get_template_part('special/loop');

		endwhile;
	endif;
	if (function_exists('wp_pagenavi')) {wp_pagenavi(array('query' => $news_query));}
?>


					</section>
				</div>
			</article>

			<?php get_sidebar(); ?>
		</div>
	</main>

<?php
get_footer(); ?>
