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

				<h1 class="ttlLev1"><?php the_title(); ?></h1>

				<div class="contents-box">

<?php
if (is_user_logged_in() && isset($_GET['product_id'])) :
	while (have_posts()) : the_post();

		the_content();

	endwhile;
else :
?>

	<p>当店で商品をご購入頂いたお客様からの「商品についてのご意見・ご感想」を掲載しております。<br>
	ご購入商品のご意見・ご感想は、マイページ「注文履歴」からご投稿が出来ます。是非、皆様のお声をお聞かせください。</p>

	<div class="btn-box"><a href="<?php echo esc_url(home_url()); ?>/myaccount/orders"><span>注文履歴はこちら</span></a></div>



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
