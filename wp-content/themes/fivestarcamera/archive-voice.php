<?php
/**
 * The template for displaying voice.
 */

get_header();
?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents">

				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1">お客様の声</h1>

				<div class="contents-box">

					<section id="intro" class="column">
						<p>当店で商品をご購入頂いたお客様からの「商品についてのご意見・ご感想」を掲載しております。<br>ご購入商品のご意見・ご感想は、マイページ「注文履歴」からご投稿が出来ます。是非、皆様のお声をお聞かせください。</p>
						<div class="btn-box"><a href="<?php echo esc_url(home_url()); ?>/myaccount/orders"><span>注文履歴はこちら</span></a></div>
					</section>

					<section id="voice" class="column">

<?php
	while ( have_posts() ) : the_post();
?>
	<div class="entry">
		<h2 class="ttlLev3"><?php the_title(); ?></h2>
<?php
		if (function_exists('get_voice_star')) :
?>
		<div class="star"><?php echo get_voice_star(get_field('voice_star')); ?></div>
<?php
		endif;
?>
		<div class="info"><span class="date"><?php the_time("Y.n.j"); ?></span><span class="customer"><?php the_field('voice_customer'); ?></span></div>
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
